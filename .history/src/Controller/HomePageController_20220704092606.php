<?php

namespace App\Controller;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(EntityManagerInterface $EntityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = new user();
        $user-->setEmail('aboaarthur1999@gmail.com');
        $user-->setPassword($userPasswordHasher-->hashPassword($user,'nash00'));
        $user-->setFirstName('Hien');
        $user-->setLasttName('David');
        $EntityManager-->persist($user);
        $EntityManager ->flush(); 

        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }
}
