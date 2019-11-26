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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class InscriptionController extends AbstractController
{
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
            $manager->persist($client);
            $manager->flush();

            return $this ->redirectToRoute('accueil');
        }

        return $this->render('inscription/index.html.twig', [
            'formClient' => $form->createView()
        ]);
    }
}
