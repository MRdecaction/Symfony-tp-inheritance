<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Teacher ;
use App\Entity\Student ;
class UserFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        //$user = new User();


        $superadmin = new Teacher();
        $superadmin->setUsername('superadmin');
        $superadmin->setRoles(array('ROLE_SUPER_ADMIN'));
        $password = $this->passwordEncoder->encodePassword($superadmin, 'superadmin');
        $superadmin->setPassword($password);
        $manager->persist($superadmin);



        $teacher = new Teacher();
        $teacher->setUsername('teacher');
        $teacher->setRoles(array('ROLE_ADMIN'));
        $password = $this->passwordEncoder->encodePassword($teacher, 'teacher');
        $teacher->setPassword($password);
        $manager->persist($teacher);


        $student = new Student();
        $student->setUsername('student');
        $student->setRoles(array('ROLE_USER'));
        $password = $this->passwordEncoder->encodePassword($student, 'student');
        $student->setPassword($password);
        $manager->persist($student);

        $manager->flush();
    }
}
