<?php

namespace App\Controller;

use App\Repository\ScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FooterController extends AbstractController
{
    public function getFooter(ScheduleRepository $scheduleRepository): Response
    {
        return $this->render('footer/footer.html.twig', [
           'restaurantSchedule' => $scheduleRepository->findAll(),
            'neededScheduledDays' => [
                'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'
            ]
        ]);
    }
}
