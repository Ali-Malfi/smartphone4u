<?php

namespace App\Controller;

use App\Entity\Smartphone;
use App\Form\SmartphoneType;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(EntityManagerInterface $entityManager , Request $request): Response
    {
        $smartphone = new Smartphone();
        $form =$this->createForm(SmartphoneType::class, $smartphone);

        $form->handleRequest($request);
        if ($form-> isSubmitted() && $form-> isValid()) {
            $smartphone = $form->getData();
            $entityManager->persist($smartphone);
            $entityManager->flush();
            $this->addFlash('success', 'Het telefoon is toegevoegd');
            return $this->redirectToRoute('app_home');
        }
        return $this->render('smartphone/index.html.twig', [
            'controller_name' => 'SmartphoneController',
            'form' => $form,
//            dd($smartphone)
        ]);
    }

    #[Route('/smartphone/edit/{id}', name: 'app_smartphone_update')]
    public function edit(EntityManagerInterface $entityManager, Request $request, Smartphone $smartphone): Response
    {

        $form = $this->createForm(SmartphoneType::class, $smartphone);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($smartphone);
            $entityManager->flush();
            $this->addFlash('success', 'Smartphone is aangepast');
            return $this->redirectToRoute('app_home', ['smartphone' => $smartphone->getId()]);
        }
        return $this->render('smartphone/index.html.twig', [
            'form' => $form,
        ]);

    }


    #[Route('/smartphone/delete/{id}', name: 'app_smartphone_delete')]
    public function delete(Smartphone $smartphone, EntityManagerInterface $entityManager): Response {
        $entityManager->remove($smartphone);
        $entityManager->flush();
        $this->addFlash('success', 'Boek is gewist');
        return $this->redirectToRoute('app_home');
    }
}
