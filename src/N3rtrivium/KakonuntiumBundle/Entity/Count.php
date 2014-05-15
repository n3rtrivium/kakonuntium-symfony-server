<?php

namespace N3rtrivium\KakonuntiumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Count
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="N3rtrivium\KakonuntiumBundle\Repository\CountRepository")
 */
class Count
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
     * @ORM\Column(name="lecture", type="object")
     */
    private $lecture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="submitTime", type="datetime")
     */
    private $submitTime;

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
     * Set lecture
     *
     * @param \stdClass $lecture
     * @return Count
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
     * Set submitTime
     *
     * @param \DateTime $submitTime
     * @return Count
     */
    public function setSubmitTime($submitTime)
    {
        $this->submitTime = $submitTime;

        return $this;
    }

    /**
     * Get submitTime
     *
     * @return \DateTime 
     */
    public function getSubmitTime()
    {
        return $this->submitTime;
    }

    /**
     * Set which
     *
     * @param string $which
     * @return Count
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
