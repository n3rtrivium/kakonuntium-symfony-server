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
                'Y-m-d string specifing the maximum future date of lectures to be imported',
                InputOption::VALUE_NONE
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
            $output->writeln("error: could not read ical file from source");
            return;
        }
        
        $calendar = Reader::read($icalData);
        $output->writeln("ical data has been read into memory");
        
        $maxFutureDate = new \DateTime();
        $maxFutureDate->add(new \DateInterval('P1Y'));
        if ($input->getOption('maxFutureDate'))
        {
            $maxFutureDate = \DateTime::createFromFormat('Y-m-d', $input->getOption('maxFutureDate'));
            if ($maxFutureDate === false)
            {
                $output->writeln("error: could not read maxFutureDate (required format: Y-m-d)");
                return;
            }
        }
        else
        {
            $output->writeln(sprintf('parsing implicitly only events until "%s"', $maxFutureDate->format('Y-m-d')));
        }
        
        // Expand recurring events
        $calendar->expand(new \DateTime(), $maxFutureDate);
        
        $foundEvents = array();
        foreach ($calendar->VEVENT as $event)
        {
            $event->DTSTART;
            $event->UID;
            $event->DTEND;
        }

        $output->writeln($text);
    }
}