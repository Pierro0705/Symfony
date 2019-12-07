<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Bien;
use App\Entity\Louer;
use App\Entity\Client;

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
    public function index(Request $request)
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
                        'input'  => 'string',
                        'attr' => [
                            'class' => 'form-control',
                            'min' => date('Y-m-d')
                        ]
                    ])
                    ->add('dateDepart' , DateType::class,  [
                        'widget' => 'single_text',
                        'input'  => 'string',
                        'attr' => [
                            'class' => 'form-control',
                            'min' => date('Y-m-d')
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
                    'mailPro' => '',
                    'erreur' => 'Les dates ne sont pas cohérentes'
                ]);
            }
            else
            {
                $resultats = $repository->rechercheBien($data['ville'],$data['nbPlaces'],$data['superficieMin'],$data['superficieMax'],$data['typeBien'],$data['dateArrivee'],$data['dateDepart']);

                dump($resultats);
                if ($maSession == "")
                {
                    return $this ->redirectToRoute('connexion');
                }
                else
                {
                    return $this->render('accueil/bien.html.twig', [
                        'mail' => $maSession,
                        'biens' => $resultats,
                        'mailPro' => '',
                        'erreur' => ''
                    ]);
                }
            }
        }

        return $this->render('accueil/index.html.twig', [
            'mail' => $maSession,
            'formRecherche' => $form->createView(),
            'biensRandom' => $random,
            'mailPro' => '',
            'erreur' => ''
        ]);
    }
    

    /**
     * @Route("/biens/{id}", name="bienDetaille")
     */
    public function descBien($id, Request $request, EntityManagerInterface $manager)
    {
        $maSession = $this->session->get('mail');

        $repo = $this->getDoctrine()->getRepository(Bien::class);

        $bien = $repo->findBienById($id);

        $formF = $this->createFormBuilder()
        ->add('dateArrivee' , DateType::class, [
           'widget' => 'single_text',
           'input'  => 'string',
           'attr' => [
               'class' => 'form-control',
               'min' => date('Y-m-d')
           ]
       ])
       ->add('dateDepart' , DateType::class,  [
           'widget' => 'single_text',
           'input'  => 'string',
           'attr' => [
               'class' => 'form-control',
               'min' => date('Y-m-d')
           ]
       ])
       ->add('valider' , SubmitType::class,  [
        'label' => 'Réserver',
        'attr' => [
            'placeholder' => 'denis',
            'class' => 'btn south-btn'
            ]
        ])
        ->getForm();

        $formF->handleRequest($request);

        if($formF->isSubmitted() && $formF->isValid())
        {
            $data = $formF->getData();

            if ($data['dateDepart'] < $data['dateArrivee'])
            {
                return $this->render('accueil/show.html.twig', [
                    'formValider' => $formF->createView(),
                    'resultats' => $bien,
                    'mailPro' => '',
                    'mail' => $maSession,
                    'erreur' => 'Les dates ne sont pas cohérentes'
                ]);
            }
            else
            {
                if ($maSession == "")
                {
                    return $this ->redirectToRoute('connexion');
                }
                else
                {
                    $verifDispo = $repo->verifDispo($data['dateArrivee'],$data['dateDepart'],$id);

                    if ($verifDispo[0][1] == 0)
                    {
                        return $this->render('accueil/show.html.twig', [
                            'formValider' => $formF->createView(),
                            'resultats' => $bien,
                            'mail' => $maSession,
                            'mailPro' => '',
                            'erreur' => 'Cette location est déja louée à ces dates, veuillez les changer'
                        ]);
                    }
                    else if ($verifDispo[0][1] == 1) 
                    {
                        $repoClient = $this->getDoctrine()->getRepository(Client::class);

                        $monBien = $repo->findOneBySomeField($id);
                        $monClient = $repoClient->findOnebySomeField($maSession);
                        $reqPrix = $repo->prixTotal($id,$data['dateArrivee'],$data['dateDepart']);
                        $prixTotal = (int) $reqPrix[0]['prixtotal'];

                        $location = new Louer();

                        $location->setBien($monBien)
                                 ->setClient($monClient)
                                 ->setDatearrivee($data['dateArrivee'])
                                 ->setDatedepart($data['dateDepart'])
                                 ->setPrix($prixTotal)
                                 ->setStatus("En attente");
                                 

                        $this->session->set('location',$location);
                        
                        return $this->redirectToRoute('paiement');
                    }
                }
            }
        }

        if ($maSession == "")
        {
            return $this ->redirectToRoute('connexion');
        }
        else
        {
            return $this->render('accueil/show.html.twig', [
                'formValider' => $formF->createView(),
                'resultats' => $bien,
                'mail' => $maSession,
                'mailPro' => '',
                'erreur' => ''
            ]);
        }
    }


    /**
     * @Route("/accueil/deconnexion", name="deconnexion")
     */
    public function deconnexion(Request $request)
    {
        $this->session->remove('mail');
        $this->session->remove('mailPro');

        return $this ->redirectToRoute('accueil');
    }
}
