<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use App\Entity\Proprietaire;
use App\Entity\Louer;

use Doctrine\ORM\EntityManagerInterface;

class ProprietaireController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/proprietaire/connexion", name="proprietaire")
     */
    public function connexion(Request $request)
    {
        $proprietaire = new Proprietaire();

        $form = $this->createFormBuilder($proprietaire)
                     ->add('mailproprietaire', EmailType::class, [
                         'attr' => [
                            'placeholder' => 'Email',
                            'class' => 'form-control'
                        ]
                    ])
                     ->add('mdpproprietaire' , PasswordType::class,  [
                        'attr' => [
                            'placeholder' => 'Mot de passe',
                            'class' => 'form-control'
                        ]
                    ])
                     ->add('valider' , SubmitType::class,  [
                        'attr' => [
                            'placeholder' => 'Valider',
                            'class' => 'btn south-btn'
                        ]
                    ])
                     ->getForm();

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $mdp1 = $proprietaire->getMdpproprietaire();
            $mdpCrypte = sha1($mdp1);
            $mail1 = $proprietaire->getMailproprietaire();

            $repository = $this->getDoctrine()->getRepository(Proprietaire::class);
            
            $verifProprietaire = $repository->verifProprietaire($mail1,$mdpCrypte);
            
            if ($verifProprietaire[0][1] == 1)
            {
                $this->session->set('mailPro',$mail1);
                return $this ->redirectToRoute('espaceproprietaire');
            }
            else if ($verifProprietaire[0][1] == 0)
            {
                return $this ->render('proprietaire/index.html.twig', [
                    'formConnect' => $form->createView(),
                    'mail' => '',
                    'mailPro' => '',
                    'erreur' => 'Adresse mail ou mot de passe incorrect'
                ]);
            }
            
        }

        $maSession = $this->session->get('mail');
        
        if ($maSession != '')
        {
            return $this ->redirectToRoute('accueil');
        }
        else
        {
            return $this->render('proprietaire/index.html.twig', [
                'formConnect' => $form->createView(),
                'mail' => '',
                'mailPro' => '',
                'erreur' => ''
            ]);
        }
    }

    /**
     * @Route("/proprietaire/espacepro", name="espaceproprietaire")
     */
    public function espacePro(Request $request)
    {
        $maSession = $this->session->get('mail');
        $maSessionPro = $this->session->get('mailPro');
        if ($maSessionPro == '')
        {
            return $this ->redirectToRoute('accueil');
        }
        else 
        {
            $repository = $this->getDoctrine()->getRepository(Proprietaire::class);

            $requete = $repository->getLocations($maSessionPro);

            return $this->render('proprietaire/espace.html.twig', [
                'mail' => $maSession,
                'mailPro' => $maSessionPro,
                'locations' => $requete
            ]);
        }
    }

    /**
     * @Route("/proprietaire/espacepro/{id}/{action}", name="espaceproprietaireid")
     */
    public function action($id,$action,EntityManagerInterface $manager)
    {
        $maSessionPro = $this->session->get('mailPro');

        $repository = $this->getDoctrine()->getRepository(Louer::class);

        $requete = $repository->findOneBySomeField($id);

        
        if ($maSessionPro == '')
        {
            return $this ->redirectToRoute('accueil');
        }
        else 
        {
            if ($action == "accept")
            {
                $requete->setStatus("Confirmé");
                $manager->flush();
            }
            if ($action == "refuse")
            {
                $requete->setStatus("Refusé");
                $manager->flush();
            }
            return $this ->redirectToRoute('espaceproprietaire');
        }
    }
}
