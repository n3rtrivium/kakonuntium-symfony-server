<?php

namespace N3rtrivium\KakonuntiumBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Sabre\VObject\Reader;

class ImportCalendarCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('kakonuntium:lectures:import')
            ->setDescription('Import lectures from the application-defined calendar')
            ->addOption(
                'maxFutureDate',
                null,
                InputOption::VALUE_OPTIONAL,
                'Y-m-d string specifing the maximum future date of lectures to be imported'
                //InputOption::VALUE_NONE
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $icalPath = $this->getContainer()->getParameter('n3rtrivium_kakonuntium.lectures_ical_source');
        
        $output->writeln(sprintf('reading ical file from "%s"', $icalPath));
        $icalData = file_get_contents($icalPath);
        if ($icalData === false)
        {
            $output->writeln("<error>error: could not read ical file from source</error>");
            return;
        }
        
        $calendar = Reader::read($icalData);
        $output->writeln("ical data has been read into memory");
        
        $today = new \DateTime('midnight', new \DateTimeZone('Europe/Vienna'));
        
        $maxFutureDate = new \DateTime('midnight', new \DateTimeZone('Europe/Vienna'));
        $maxFutureDate->add(new \DateInterval('P1Y'));
        
        if ($input->getOption('maxFutureDate'))
        {
            $maxFutureDate = \DateTime::createFromFormat('Y-m-d', $input->getOption('maxFutureDate'),
                new \DateTimeZone('Europe/Vienna'));
            if ($maxFutureDate === false)
            {
                $output->writeln("<error>error: could not read maxFutureDate (required format: Y-m-d)</error>");
                return;
            }
            
            $output->writeln(sprintf('parsing explicitly only events until "%s"', $maxFutureDate->format('Y-m-d')));
        }
        else
        {
            $output->writeln(sprintf('parsing implicitly only events until "%s"', $maxFutureDate->format('Y-m-d')));
        }
        
        // Expand recurring events
        $calendar->expand($today, $maxFutureDate);
        
        $foundEvents = array();
        foreach ($calendar->VEVENT as $event)
        {
            // if already done, skip it
            if ($event->DTSTART->getDateTime() < $today)
            {
                if ($output->isVerbose())
                {
                    $output->writeln(sprintf('event "%s" of "%s" already ended, ignoring', $event->SUMMARY,
                        $event->DTSTART->getDateTime()->format('Y-m-d')));
                }
                    
                continue;
            }
            
            // if too far in the future, skip it
            if ($event->DTSTART->getDateTime() > $maxFutureDate)
            {
                if ($output->isVerbose())
                {
                    $output->writeln(sprintf('event "%s" of "%s" too far in future, ignoring', $event->SUMMARY,
                        $event->DTSTART->getDateTime()->format('Y-m-d')));
                }
                    
                continue;
            }

            $eventHash = md5($event->UID . 'x' . $event->DTSTART . 'x' . $event->DTEND);
            
            $startTime = $event->DTSTART->getDateTime();
            $startTime->setTimezone(new \DateTimeZone('Europe/Vienna'));
            
            $endTime = $event->DTEND->getDateTime();
            $endTime->setTimezone(new \DateTimeZone('Europe/Vienna'));
            
            $foundEvents[$eventHash] = array(
                'hash' => $eventHash,
                'title' => $event->SUMMARY,
                'start' => $startTime,
                'end' => $endTime
            );
            
            $output->writeln(sprintf('found event %s: "%s", duration %s to %s', $eventHash, $event->SUMMARY,
                $startTime->format('Y-m-d H:i'), $endTime->format('Y-m-d H:i')));
        }
        
        $lectureRepository = $entityManager->getRepository('N3rtriviumKakonuntiumBundle:Lecture');
        $foundLectures = $lectureRepository->findOpenLecturesBetweenDates($today, $maxFutureDate);
        
        $output->writeln('sorting out events from database which have not been updated');
        
        $knownHashes = array(); // hashes for events that should NOT be inserted into the DB
        foreach ($foundLectures as $foundLecture)
        {
            if (!array_key_exists($foundLecture->getCalendarHash(), $foundEvents))
            {
                $output->writeln(sprintf('removing DB event %s: "%s", duration %s to %s', $foundLecture->getCalendarHash(),
                    $foundLecture->getName(), $foundLecture->getBeginTime()->format('Y-m-d H:i'),
                    $foundLecture->getEndTime()->format('Y-m-d H:i')));
                
                $this->entityManager->remove($foundLecture);
                continue;
            }
            
            $knownHashes[] = $foundLecture->getCalendarHash();
        }
        
        $this->entityManager->flush();
        
        $output->writeln('removed specified events from database');
        $output->writeln('sorting out hashes not in the database (for event insertion)');
        
        foreach ($foundEvents as $hash => $event)
        {
            if (in_array($hash, $knownHashes))
            {
                $output->writeln(sprintf('insertion: skipping hash %s', $hash));
                continue;
            }
            
            $lecture = new Lecture();
            $lecture->setName($event['title']);
            $lecture->setBeginTime($event['start']);
            $lecture->setEndTime($event['end']);
            $lecture->setPhase(Lecture::PHASE_OPEN);
            $lecture->setCalendarHash($hash);
            
            $output->writeln(sprintf('adding DB event %s: "%s", duration %s to %s', $lecture->getCalendarHash(),
                    $lecture->getName(), $lecture->getBeginTime()->format('Y-m-d H:i'),
                    $lecture->getEndTime()->format('Y-m-d H:i')));

            $this->entityManager->persist($lecture);
        }
        
        $output->writeln('writing new events to database');
        $this->entityManager->flush($lecture);
        
        $output->writeln('finished!');
    }
    
    
}