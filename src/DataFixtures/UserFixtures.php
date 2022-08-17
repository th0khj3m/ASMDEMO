<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
      //Khởi tạo constructor để import thư viện UserPasswordHasherInterface
    public function __construct(UserPasswordHasherInterface $hasherInterface)
    {
        $this -> hasher = $hasherInterface;
    }
  
    public function load(ObjectManager $manager): void
    {
        $user = new User;
        $user -> setUsername("admin"); //unique
        $user -> setRoles(["ROLE_ADMIN"]); //security.yaml
        $user -> setPassword($this -> hasher -> hashPassword($user, "123456")); //__construct
        $manager -> persist($user);

        $user = new User;
        $user -> setUsername("user"); //unique
        $user -> setRoles(["ROLE_USER"]); //security.yaml
        $user -> setPassword($this -> hasher -> hashPassword($user, "123456")); //__construct
        $manager -> persist($user);

        $manager->flush();
    }
}