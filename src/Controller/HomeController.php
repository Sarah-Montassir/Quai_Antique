<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/carte', name: 'carte')]
    public function carte(): Response
    {
        return $this->render('home/carte.html.twig');
    }

    #[Route('/reservation', name: 'reservation')]
    public function reservation(): Response
    {
        return $this->render('home/reservation.html.twig');
    }
}
