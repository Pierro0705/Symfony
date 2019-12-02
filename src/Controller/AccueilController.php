<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Bien;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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

        $repository = $this->getDoctrine()->getRepository(Bien::class);

        $random = $repository->bienRandom();

        $form = $this->createFormBuilder()
                     ->add('ville', TextType::class, [
                         'attr' => [ 
                            'class' => 'form-control',
                            'placeholder' => 'Ex : Paris'
                        ]
                    ])
                     ->add('nbPlaces' , TextType::class,  [
                        'attr' => [
                            'class' => 'form-control',
                            'placeholder' => 'Ex : 5'
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
                    ->add('dateArrivee' , DateType::class, [
                        'widget' => 'single_text',
                        'attr' => [
                            'class' => 'form-control',
                            'min' => date('Y-m-d')
                        ]
                    ])
                    ->add('dateDepart' , DateType::class,  [
                        'widget' => 'single_text',
                        'attr' => [
                            'class' => 'form-control',
                            'min' => date('Y-m-d', strtotime("+1 day"))
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

        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            if ($data['dateDepart'] < $data['dateArrivee'])
            {
                return $this->render('accueil/index.html.twig', [
                    'mail' => $maSession,
                    'formRecherche' => $form->createView(),
                    'biensRandom' => $random,
                    'erreur' => 'Les dates ne sont pas cohérentes'
                ]);
            }
            else
            {
                $resultats = $repository->rechercheBien($data['ville'],$data['nbPlaces'],$data['superficieMin'],$data['superficieMax'],$data['typeBien'],$data['dateArrivee'],$data['dateDepart']);

                if ($maSession == "")
                {
                    return $this ->redirectToRoute('connexion');
                }
                else
                {
                    return $this->render('accueil/bien.html.twig', [
                        'mail' => $maSession,
                        'biens' => $resultats,
                        'erreur' => ''
                    ]);
                }
            }
        }

        return $this->render('accueil/index.html.twig', [
            'mail' => $maSession,
            'formRecherche' => $form->createView(),
            'biensRandom' => $random,
            'erreur' => ''
        ]);
    }
    

    /**
     * @Route("/biens/{id}", name="bienDetaille")
     */
    public function descBien($id)
    {
        $maSession = $this->session->get('mail');

        $repo = $this->getDoctrine()->getRepository(Bien::class);

        $bien = $repo->find($id);

        if ($maSession == "")
        {
            return $this ->redirectToRoute('connexion');
        }
        else
        {
            return $this->render('accueil/show.html.twig', [
                'bien' => $bien,
                'mail' => $maSession
            ]);
        }
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
