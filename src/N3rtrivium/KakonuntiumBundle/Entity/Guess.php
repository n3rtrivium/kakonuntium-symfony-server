<?php

namespace N3rtrivium\KakonuntiumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guess
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="N3rtrivium\KakonuntiumBundle\Repository\GuessRepository")
 */
class Guess
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
     * @var \stdClass
     *
     * @ORM\Column(name="user", type="object")
     */
    private $user;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="lecture", type="object")
     */
    private $lecture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insertTime", type="datetime")
     */
    private $insertTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateTime", type="datetime")
     */
    private $updateTime;

    /**
     * @var string
     *
     * @ORM\Column(name="which", type="string", length=20)
     */
    private $which;


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
     * Set user
     *
     * @param \stdClass $user
     * @return Guess
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \stdClass 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set lecture
     *
     * @param \stdClass $lecture
     * @return Guess
     */
    public function setLecture($lecture)
    {
        $this->lecture = $lecture;

        return $this;
    }

    /**
     * Get lecture
     *
     * @return \stdClass 
     */
    public function getLecture()
    {
        return $this->lecture;
    }

    /**
     * Set insertTime
     *
     * @param \DateTime $insertTime
     * @return Guess
     */
    public function setInsertTime($insertTime)
    {
        $this->insertTime = $insertTime;

        return $this;
    }

    /**
     * Get insertTime
     *
     * @return \DateTime 
     */
    public function getInsertTime()
    {
        return $this->insertTime;
    }

    /**
     * Set updateTime
     *
     * @param \DateTime $updateTime
     * @return Guess
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime 
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * Set which
     *
     * @param string $which
     * @return Guess
     */
    public function setWhich($which)
    {
        $this->which = $which;

        return $this;
    }

    /**
     * Get which
     *
     * @return string 
     */
    public function getWhich()
    {
        return $this->which;
    }
}
