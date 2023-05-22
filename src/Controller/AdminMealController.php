<?php

namespace App\Controller;

use App\Repository\MealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/admin')]
class AdminMealController extends AbstractController
{
    #[Route('/meal', name: 'app_get_admin_meal')]
    public function getMeal(MealRepository $mealRepository, SerializerInterface $serializer): Response
    {
        $meals = $serializer->serialize($mealRepository->findAll(), 'json', ['groups' => ['meal:read']]);

        return $this->render('admin/meal/meal.html.twig', [
            'meals' => json_decode($meals),
        ]);
    }
}
