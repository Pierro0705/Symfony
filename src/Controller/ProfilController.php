<?php

namespace App\Controller;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProfilController extends AbstractController
{
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/profil", name="profil")
     */
    public function index(Request $request, EntityManagerInterface $manager)
    {
        $mail = $this->session->get('mail');

        $repository = $this->getDoctrine()->getRepository(Client::class);

        $monUser = $repository->findOneBySomeField($mail);

        
        $collection = $monUser->getLouers()->toArray();

        $formUpdate = $this->createFormBuilder()
        ->add('nom' , TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Votre nom',
                'value' => $monUser->getNom()
            ]
        ])
        ->add('prenom' , TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Votre prénom',
                'value' => $monUser->getPrenom()
            ]
        ])
        ->add('mdp' , TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Mot de passe',
                'value' => $monUser->getMdp()
            ]
        ])
        ->add('valider' , SubmitType::class,  [
            'attr' => [
                'placeholder' => 'Valider',
                'class' => 'btn south-btn'
            ]
        ])
        ->getForm();


        $formUpdate->handleRequest($request);

        if($formUpdate->isSubmitted() && $formUpdate->isValid())
        {
            $data = $formUpdate->getData();

            $monUser->setNom($data['nom'])
                    ->setPrenom($data['prenom'])
                    ->setMdp(sha1($data['mdp']));

            $manager->flush();

            return $this->redirectToRoute('profil');
        }

        if ($mail == '')
        {
            return $this ->redirectToRoute('accueil');
        }
        else
        {
            return $this->render('profil/index.html.twig', [
                'mail' => $mail,
                'locations' => $collection,
                'mailPro' => '',
                'formUpdate' => $formUpdate->createView()
            ]);
        }
    }
}
