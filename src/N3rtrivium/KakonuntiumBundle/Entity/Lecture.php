<?php

namespace N3rtrivium\KakonuntiumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Lecture
 *
 * @ORM\Table(name="lectures")
 * @ORM\Entity(repositoryClass="N3rtrivium\KakonuntiumBundle\Repository\LectureRepository")
 */
class Lecture
{
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
     */
    private $phase;

    /**
     * @var User|null
     *
     * @ORM\JoinColumn(name="admin_user_id", referencedColumnName="id", nullable=true)
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $adminUser;

    /**
     * @var User|null
     *
     * @ORM\JoinColumn(name="winner_user_id", referencedColumnName="id", nullable=true)
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $winnerUser;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Guess", mappedBy="lecture")
     **/
    private $guesses;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Count", mappedBy="lecture")
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
     * @param User|null $adminUserId
     * @return Lecture
     */
    public function setAdminUserId($adminUser)
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
}
