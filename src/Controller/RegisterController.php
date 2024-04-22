<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User;

        $form = $this -> createForm(RegisterType::class, $user);

        $form -> handleRequest($request);

        if ($form->isSubmitted() && $form-> isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('register/index.html.twig', [
            'registerForm' => $form -> createView()
        ]);
    }
}
