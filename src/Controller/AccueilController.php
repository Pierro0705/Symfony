<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Bien;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class AccueilController extends AbstractController
{
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="accueil")
     */
    public function index(Request $request, EntityManagerInterface $manager)
    {
        
        $maSession = $this->session->get('mail');

        $form = $this->createFormBuilder()
                     ->add('ville', TextType::class, [
                         'attr' => [ 
                            'class' => 'form-control'
                        ]
                    ])
                     ->add('nbPlaces' , TextType::class,  [
                        'attr' => [
                            'class' => 'form-control'
                        ]
                    ])
                    ->add('superficieMin' , TextType::class,  [
                        'attr' => [
                            'class' => 'form-control',
                            'placeholder' => 'En m²'
                        ]
                    ])
                    ->add('superficieMax' , TextType::class,  [
                        'attr' => [
                            'class' => 'form-control',
                            'placeholder' => 'En m²'
                        ]
                    ])
                    ->add('typeBien' , ChoiceType::class,  [
                        'attr' => [
                            'class' => 'form-control',
                            'placeholder' => 'En m²'
                        ],
                        'choices'  => [
                            'Appartement' => 'Appartement',
                            'Maison' => 'Maison'
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

        $repository = $this->getDoctrine()->getRepository(Bien::class);

        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $resultats = $repository->rechercheBien($data['ville'],$data['nbPlaces'],$data['superficieMin'],$data['superficieMax'],$data['typeBien']);

            if ($maSession == "")
            {
                return $this ->redirectToRoute('connexion');
            }
            else
            {
                return $this->render('bien/index.html.twig', [
                    'mail' => $maSession,
                    'biens' => $resultats
                ]);
            }
        }

        $random = $repository->bienRandom();

        return $this->render('accueil/index.html.twig', [
            'mail' => $maSession,
            'formRecherche' => $form->createView(),
            'biensRandom' => $random
        ]);
    }

    /**
     * @Route("/accueil/deconnexion", name="deconnexion")
     */
    public function deconnexion(Request $request)
    {
        $this->session->remove('mail');

        return $this ->redirectToRoute('accueil');
    }
}
