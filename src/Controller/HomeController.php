<?php

namespace App\Controller;

use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(PictureRepository $pictureRepository): Response
    {
        return $this->render('home/home.html.twig', [
            'pictures' => $pictureRepository->findAll(),
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
