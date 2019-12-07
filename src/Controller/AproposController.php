<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AproposController extends AbstractController
{
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/apropos", name="apropos")
     */
    public function index()
    {
        $maSession = $this->session->get('mail');
        $maSessionPro = $this->session->get('mailPro');

        return $this->render('apropos/index.html.twig', [
            'mail' => $maSession,
            'mailPro' => $maSessionPro

        ]);
    }
}
