<?php

namespace App\Controller;

use App\Entity\Smartphone;
use App\Form\SmartphoneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SmartphoneController extends AbstractController
{
//    #[Route('/smartphone', name: 'app_smartphone')]
//    public function index(): Response
//    {
//        $smartphone = new Smartphone();
//        $form =$this->createForm(SmartphoneType::class, $smartphone);
//
//        return $this->render('smartphone/index.html.twig', [
//            'controller_name' => 'SmartphoneController',
//            'form' => $form,
//        ]);
//    }


    #[Route('/smartphone', name: 'app_smartphone')]
    public function index(Request $request): Response
    {
        $smartphone = new Smartphone();
        $form =$this->createForm(SmartphoneType::class, $smartphone);

        $form->handleRequest($request);
        if ($form-> isSubmitted() && $form-> isValid()) {
            $smartphone = $form->getData();
        }
        return $this->render('smartphone/index.html.twig', [
            'form' => $form,
        ]);
    }
}
