<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private const MAIN_USERNAME = 'user';
    private const MAIN_PASSWORD = 'pa$$word';

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername(self::MAIN_USERNAME);
        $user->setPassword($this->passwordEncoder->encodePassword($user, self::MAIN_PASSWORD));
        $user->setRoles([User::DEFAULT_ROLE]);

        $manager->persist($user);
        $manager->flush();
    }
}
