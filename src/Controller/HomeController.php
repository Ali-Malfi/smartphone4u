<?php

namespace App\Controller;

use App\Entity\Smartphone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $smartphones =$entityManager->getrepository(Smartphone::class)->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'smartphones' => $smartphones,
        ]);
    }
}
