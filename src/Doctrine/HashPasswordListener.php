<?php

declare(strict_types=1);

namespace App\Doctrine;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HashPasswordListener
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function prePersist(User $user)
    {
        $this->encodePassword($user);
    }

    public function preUpdate(User $user, LifecycleEventArgs $args)
    {
        $this->encodePassword($user);

        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($user));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $user);
    }

    private function encodePassword(User $user)
    {
        if (!$user instanceof User) {
            return;
        }

        $plainPassword = $user->getPlainPassword();
        if (!$plainPassword) {
            return;
        }

        $password = $this->passwordEncoder->encodePassword(
            $user,
            $plainPassword
        );

        $user->setPassword($password);
    }
}