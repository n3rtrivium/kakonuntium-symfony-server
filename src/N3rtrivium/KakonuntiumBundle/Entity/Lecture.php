<?php

namespace N3rtrivium\KakonuntiumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\JsonSerializationVisitor;

/**
 * Lecture
 *
 * @ORM\Table(name="lectures"uniqueConstraints={
 *     @ORM\UniqueConstraint(name="unique_calendar_hash", columns={"ical_hash"})
 * })
 * @ORM\Entity(repositoryClass="N3rtrivium\KakonuntiumBundle\Repository\LectureRepository")
 */
class Lecture
{
	const PHASE_OPEN = 0;

	const PHASE_RUNNING = 1;

	const PHASE_ENDED = 2;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="beginTime", type="datetime")
     */
    private $beginTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endTime", type="datetime")
     */
    private $endTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="phase", type="smallint")
     * @Serializer\Exclude
     */
    private $phase;

    /**
     * @var User|null
     *
     * @ORM\JoinColumn(name="admin_user_id", referencedColumnName="id", nullable=true)
     * @ORM\ManyToOne(targetEntity="User")
     * @Serializer\Exclude
     */
    private $adminUser;

    /**
     * @var User|null
     *
     * @ORM\JoinColumn(name="winner_user_id", referencedColumnName="id", nullable=true)
     * @ORM\ManyToOne(targetEntity="User")
     * @Serializer\Exclude
     */
    private $winnerUser;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ical_hash", type="string", length=32, nullable=false)
     */
    private $calendarHash;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Guess", mappedBy="lecture")
     * @Serializer\Exclude
     **/
    private $guesses;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Count", mappedBy="lecture")
     * @Serializer\Exclude
     **/
    private $countings;

    public function __construct()
    {
        $this->guesses = new ArrayCollection();
        $this->countings = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Lecture
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set beginTime
     *
     * @param \DateTime $beginTime
     * @return Lecture
     */
    public function setBeginTime($beginTime)
    {
        $this->beginTime = $beginTime;

        return $this;
    }

    /**
     * Get beginTime
     *
     * @return \DateTime 
     */
    public function getBeginTime()
    {
        return $this->beginTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return Lecture
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set phase
     *
     * @param integer $phase
     * @return Lecture
     */
    public function setPhase($phase)
    {
        $this->phase = $phase;

        return $this;
    }

    /**
     * Get phase
     *
     * @return integer 
     */
    public function getPhase()
    {
        return $this->phase;
    }

    /**
     * Set admin user
     *
     * @param User|null $adminUser
     * @return Lecture
     */
    public function setAdminUser($adminUser)
    {
        $this->adminUser = $adminUser;

        return $this;
    }

    /**
     * Get admin user
     *
     * @return User|null 
     */
    public function getAdminUser()
    {
        return $this->adminUser;
    }

    /**
     * Set winning user
     *
     * @param User|null $winnerUser
     * @return Lecture
     */
    public function setWinnerUser($winnerUser)
    {
        $this->winnerUser = $winnerUser;

        return $this;
    }

    /**
     * Get winning user
     *
     * @return User|null 
     */
    public function getWinnerUser()
    {
        return $this->winnerUser;
    }
    
    /**
     * Set calendar hash
     *
     * @param string $calendarHash
     * @return Lecture
     */
    public function setCalendarHash($calendarHash)
    {
        $this->calendarHash = $calendarHash;

        return $this;
    }

    /**
     * Get calendar hash
     *
     * @return string 
     */
    public function getCalendarHash()
    {
        return $this->calendarHash;
    }
    
    /**
     * Set guesses
     *
     * @param ArrayCollection $guesses
     * @return Lecture
     */
    public function setGuesses($guesses)
    {
        $this->guesses = $guesses;

        return $this;
    }

    /**
     * Get guesses
     *
     * @return ArrayCollection 
     */
    public function getGuesses()
    {
        return $this->guesses;
    }
    
    /**
     * Set countings
     *
     * @param ArrayCollection $countings
     * @return Lecture
     */
    public function setCountings($countings)
    {
        $this->countings = $countings;

        return $this;
    }

    /**
     * Get countings
     *
     * @return ArrayCollection 
     */
    public function getCountings()
    {
        return $this->countings;
    }

	/**
	 * Used for serialization.
	 *
	 * @Serializer\VirtualProperty
	 * @Serializer\SerializedName("status")
	 *
	 * @return string
	 */
	public function serializeStatus()
	{
		if ($this->phase === self::PHASE_OPEN)
		{
			return "voting_open";
		}
		else if ($this->phase === self::PHASE_RUNNING)
		{
			return "running";
		}

		return "ended";
	}

	/**
	 * Used for serialization.
	 *
	 * @Serializer\VirtualProperty
	 * @Serializer\SerializedName("admin")
	 *
	 * @return string
	 */
	public function serializeAdmin()
	{
		if ($this->phase === self::PHASE_OPEN)
		{
			return null;
		}

		if ($this->getAdminUser() === null)
		{
			return null;
		}

		return array(
			'user_id' => $this->getAdminUser()->getPublicId(),
			'username' => $this->getAdminUser()->getUsername(),
		);
	}

	/**
	 * Used for serialization.
	 *
	 * @Serializer\VirtualProperty
	 * @Serializer\SerializedName("winner")
	 *
	 * @return string
	 */
	public function serializeWinner()
	{
		if ($this->phase !== self::PHASE_ENDED)
		{
			return null;
		}

		if ($this->getWinnerUser() === null)
		{
			return null;
		}

		return array(
			'user_id' => $this->getWinnerUser()->getPublicId(),
			'username' => $this->getWinnerUser()->getUsername(),
		);
	}

}
