<?php

namespace N3rtrivium\KakonuntiumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lecture
 *
 * @ORM\Table()
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
     * @var integer
     *
     * @ORM\Column(name="admin_user_id", type="integer")
     */
    private $adminUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="winner_user_id", type="integer")
     */
    private $winnerUser;


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
     * Set adminUserId
     *
     * @param integer $adminUserId
     * @return Lecture
     */
    public function setAdminUserId($adminUserId)
    {
        $this->adminUserId = $adminUserId;

        return $this;
    }

    /**
     * Get adminUserId
     *
     * @return integer 
     */
    public function getAdminUserId()
    {
        return $this->adminUserId;
    }

    /**
     * Set winnerUser
     *
     * @param integer $winnerUser
     * @return Lecture
     */
    public function setWinnerUser($winnerUser)
    {
        $this->winnerUser = $winnerUser;

        return $this;
    }

    /**
     * Get winnerUser
     *
     * @return integer 
     */
    public function getWinnerUser()
    {
        return $this->winnerUser;
    }
}
