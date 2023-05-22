<?php

namespace App\Controller;

use App\Entity\Schedule;
use App\Enum\DaysEnum;
use App\Form\ScheduleType;
use App\Repository\ScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/schedule')]
class AdminScheduleController extends AbstractController
{
    #[Route('', name: 'app_get_admin_schedule')]
    public function getSchedule(ScheduleRepository $scheduleRepository): Response
    {

        $scheduledDays = $scheduleRepository->findAll();

        return $this->render('admin/schedule/schedule.html.twig', [
            'scheduledDays' => $scheduledDays,
            'neededScheduledDays' => [
                'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'
            ]
        ]);
    }

    #[Route('/manage', name: 'app_post_admin_schedule')]
    public function setSchedule(Request $request, ScheduleRepository $scheduleRepository, EntityManagerInterface $entityManager): Response
    {
        $day = $request->get('day');

        $scheduledDay = $scheduleRepository->findOneBy(['day' => $day]);

        if (!$scheduledDay) {
            $scheduledDay = new Schedule();
            $scheduledDay->setDay(DaysEnum::getByDay($day));
        }

        $form = $this->createForm(ScheduleType::class, $scheduledDay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($form->getData());
            $entityManager->flush();
            $this->addFlash('success', 'Horraire mise à jour');

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/schedule/newSchedule.html.twig', [
            'scheduleForm' => $form->createView(),
        ]);
    }

}
