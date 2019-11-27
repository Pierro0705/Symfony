<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


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
