<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use App\Entity\Client;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;

class ConnexionController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connect(Request $request, EntityManagerInterface $manager)
    {
        $client = new Client();

        $form = $this->createFormBuilder($client)
                     ->add('mail', EmailType::class, [
                         'attr' => [
                            'placeholder' => 'Email',
                            'class' => 'form-control'
                        ]
                    ])
                     ->add('mdp' , PasswordType::class,  [
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
            $mdp1 = $client->getMdp();
            $mdpCrypte = sha1($mdp1);
            $mail1 = $client->getMail();

            $comptes = $this->getDoctrine()
                ->getRepository(Client::class)
                ->verifCompte($mail1,$mdpCrypte);
            
            if ($comptes[0][1] == 1)
            {
                $this->session->set('mail',$mail1);
                return $this ->redirectToRoute('accueil');
            }
            else if ($comptes[0][1] == 0)
            {
                return $this ->render('connexion/index.html.twig', [
                    'formConnect' => $form->createView(),
                    'mail' => '',
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
            return $this->render('connexion/index.html.twig', [
                'formConnect' => $form->createView(),
                'mail' => '',
                'erreur' => ''
            ]);
        }
        
    }
}
