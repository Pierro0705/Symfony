<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;


class InscriptionController extends AbstractController
{
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $client = new Client();

        $form = $this->createFormBuilder($client)
                     ->add('mail', EmailType::class, [
                         'attr' => [
                            'placeholder' => 'Email',
                            'class' => 'form-control'
                        ]
                    ])
                     ->add('nom' , TextType::class, [
                        'attr' => [
                            'placeholder' => 'Nom',
                            'class' => 'form-control'
                        ]
                    ])
                     ->add('prenom' , TextType::class, [
                        'attr' => [
                            'placeholder' => 'Prénom',
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
            $mdp = $client->getMdp();

            $mail = $client->getMail();

            $repo = $this->getDoctrine()->getRepository(Client::class);

            $res = $repo->findOneBy(['mail' => $mail]);

            if ($res)
            {
                return $this ->render('inscription/index.html.twig', [
                    'formClient' => $form->createView(),
                    'erreur' => 'Adresse mail déja utilisée'
                ]);
            }
            else
            {  
                $mdpCrypte = sha1($mdp);

                $client->setMdp($mdpCrypte);

                $manager->persist($client);
                $manager->flush();

                return $this ->redirectToRoute('connexion');
            }
            
        }
        
        $maSession = $this->session->get('mail');
        if ($maSession != '')
        {
            return $this ->redirectToRoute('accueil');
        }
        else
        {
            return $this->render('inscription/index.html.twig', [
                'formClient' => $form->createView(),
                'erreur' => '',
                'mail' => ''
            ]);
        }
    }
}
