<?php

namespace N3rtrivium\KakonuntiumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="N3rtrivium\KakonuntiumBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 */
class User
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
     * @ORM\Column(name="username", type="string", length=50)
     * @Assert\Length(
     *      min = "1",
     *      max = "50",
     *      minMessage = "Your username must be at least {{ limit }} characters length",
     *      maxMessage = "Your usenrame cannot be longer than {{ limit }} characters length"
     * )
     */
    private $username;

    /**
     * @var integer
     *
     * @ORM\Column(name="public_id", type="integer")
     */
    private $publicId;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Guess", mappedBy="user")
     **/
    private $guesses;

    public function __construct()
    {
        $this->guesses = new ArrayCollection();
    }
    
    /**
     * @ORM\PrePersist
     */
    public function generatePublicIdOnPrePersist()
    {
        $this->publicId = rand(1000000, 9999999);
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set publicId
     *
     * @param integer $publicId
     * @return User
     */
    public function setPublicId($publicId)
    {
        $this->publicId = $publicId;

        return $this;
    }

    /**
     * Get publicId
     *
     * @return integer 
     */
    public function getPublicId()
    {
        return $this->publicId;
    }
    
    /**
     * Set guesses
     *
     * @param ArrayCollection $guesses
     * @return User
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
}
