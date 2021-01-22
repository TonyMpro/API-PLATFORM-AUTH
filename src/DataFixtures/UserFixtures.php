<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setFirstname('bidule');

        $user->setLastname('test');

        $user->setEmail('test@gmail.com');
    
        $password = $this->encoder->encodePassword($user, 'mdp');
        $user->setPassword($password);

        $user->setRoles(['ROLE_USER']);
    
        $manager->persist($user);
        $manager->flush();
    }
}
