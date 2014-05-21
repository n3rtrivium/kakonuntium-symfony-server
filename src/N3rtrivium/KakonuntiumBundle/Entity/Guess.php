<?php

namespace N3rtrivium\KakonuntiumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Guess
 * @ORM\Table(name="guesses", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="unique_guesses", columns={"user_id", "lecture_id", "which"})
 * })
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
     * @var User
     *
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="User", inversedBy="guesses")
     */
    private $user;

    /**
     * @var Lecture
     *
     * @ORM\JoinColumn(name="lecture_id", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="Lecture", inversedBy="guesses")
     */
    private $lecture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insertTime", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $insertTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateTime", type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @Gedmo\Timestampable(on="update")
     */
    private $updateTime;

    /**
     * @var string
     *
     * @ORM\Column(name="which", type="string", length=20)
     */
    private $which;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="quantity", type="integer")
	 */
	private $quantity;


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
     * @param User $user
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
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set lecture
     *
     * @param Lecture $lecture
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
     * @return Lecture
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

	/**
	 * Get quantity
	 *
	 * @return string
	 */
	public function getQuantity()
	{
		return $this->quantity;
	}

	/**
	 * Set quantity
	 *
	 * @param string $quantity
	 */
	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;
	}
}
