<?php

namespace App\Controller;

use App\Entity\Louer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PaiementController extends AbstractController
{

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/paiement", name="paiement")
     */
    public function index(Request $request, EntityManagerInterface $manager)
    {
        $location = $this->session->get('location');
        $maSession = $this->session->get('mail');

        $formPaiement = $this->createFormBuilder()
        ->add('payer' , SubmitType::class,  [
            'label' => 'Payer',
            'attr' => [
                'class' => 'btn south-btn'
            ]
        ])
        ->getForm();
             
        $formPaiement->handleRequest($request);
             
        if($formPaiement->isSubmitted() && $formPaiement->isValid())
        {
            $manager->merge($location);
            $manager->flush(); 

            return $this->redirectToRoute('accueil');
        }
        return $this->render('paiement/index.html.twig', [
            'location' => $location,
            'mail' => $maSession,
            'formPaiement' => $formPaiement->createView()
        ]);
    }
}