<?php

namespace App\Controller;

use App\Entity\Lisitra;
use App\Form\LisitraType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    // : Response
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $user = new Lisitra();
        $form = $this->createForm(LisitraType::class, $user);
       
        $form->handleRequest($request);

        // valider le formulaire
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager->persist($user);
            $entityManager->flush();

            // message flash
            $this->addFlash('message', 'Modification ok !');
            return $this->redirectToRoute('home');

        }
        return $this->renderForm('home/index.html.twig', compact('form'));
    }
}
