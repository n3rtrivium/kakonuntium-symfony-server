<?php

namespace N3rtrivium\KakonuntiumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Count
 *
 * @ORM\Table(name="counts")
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
     * @var Lecture
     *
     * @ORM\JoinColumn(name="lecture_id", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="Lecture", inversedBy="countings")
     */
    private $lecture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="submitTime", type="datetime")
     * @Gedmo\Timestampable(on="create")
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
     * @param Lecture $lecture
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
     * @return lecture 
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
