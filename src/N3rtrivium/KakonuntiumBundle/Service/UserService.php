<?php

namespace N3rtrivium\KakonuntiumBundle\Service;

use Doctrine\ORM\EntityManager;
use N3rtrivium\KakonuntiumBundle\Repository\UserRepository;
use N3rtrivium\KakonuntiumBundle\Entity\User;
use N3rtrivium\KakonuntiumBundle\Model\CreateUserResponseModel;
use Symfony\Component\Validator\ValidatorInterface;

class UserService
{
	/**
	 * @var EntityManager
	 */
	private $entityManager;

	/**
	 * @var UserRepository
	 */
	private $userRepository;

	/**
	 * @var ValidatorInterface
	 */
	private $validator;
    
    public function __construct(EntityManager $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $entityManager->getRepository('N3rtriviumKakonuntiumBundle:User');
	    $this->validator = $validator;
    }

	/**
	 * @param $username
	 *
	 * @return User
	 */
	public function createUser($username)
    {
        $user = new User();
        $user->setUsername($username);

	    $errorMessages = $this->validator->validate($user);
	    if (count($errorMessages) > 0)
	    {
			return $errorMessages;
	    }
        
        $this->entityManager->persist($user);
	    $this->entityManager->flush();

	    return new CreateUserResponseModel($user->getPublicId());
    }
    
    public function retrieveUserByPublicId($publicId)
    {
        return $this->userRepository->findUserByPublicId($publicId);
    }
    
}
