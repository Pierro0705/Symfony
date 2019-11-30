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

        return $this->render('accueil/index.html.twig', [
            'mail' => $maSession
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
