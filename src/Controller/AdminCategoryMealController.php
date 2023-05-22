<?php

namespace App\Controller;

use App\Entity\CategoryMeal;
use App\Form\CategoryMealType;
use App\Repository\CategoryMealRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/admin/category/meal')]
class AdminCategoryMealController extends AbstractController
{
    #[Route('', name: 'app_admin_category_meal')]
    public function getCategoryMeal(CategoryMealRepository $mealRepository, SerializerInterface $serializer): Response
    {
        $categoryMeals = $serializer->serialize($mealRepository->findAll(), 'json', ['groups' => ['categorymeal:read']]);

        return $this->render('admin/categoryMeal/categoryMeal.html.twig', [
            'categoryMeals' => json_decode($categoryMeals),
        ]);
    }

    #[Route('', name: 'add_category_meal')]
    public function addCategoryMeal(Request $request, EntityManagerInterface $entityManager): RedirectResponse|Response
    {
        $categoryMeal = new CategoryMeal();
        $form = $this->createForm(CategoryMealType::class, $categoryMeal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($categoryMeal);
            $entityManager->flush();

            $this->addFlash('success', 'Catégorie de plat créée :)');
            return $this->redirectToRoute('app_admin_category_meal');
        }

        return $this->render('admin/categoryMeal/addCategoryMeal.html.twig', [
            'categoryMealForm' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'delete_category_meal', methods: ['DELETE'])]
    public function deleteCategoryMeal($id, EntityManagerInterface $entityManager, CategoryMealRepository $categoryMealRepository): RedirectResponse
    {
        $categoryMeal = $categoryMealRepository->find($id);

        if (!$categoryMeal) {
            throw $this->createNotFoundException();
        }

        $entityManager->remove($categoryMeal);
        $entityManager->flush();
        $this->addFlash('success', 'Catégorie de plat créée :)');

        return $this->redirectToRoute('app_admin_category_meal');
    }

    #[Route('/{id}', name: 'patch_category_meal', methods: ['PATCH'])]
    public function patchCategoryMeal($id, EntityManagerInterface $entityManager, CategoryMealRepository $categoryMealRepository, Request $request): Response
    {
        $categoryMeal = $categoryMealRepository->find($id);

        if (!$categoryMeal) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(CategoryMealType::class, $categoryMeal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd('jesuisla');
            $entityManager->persist($categoryMeal);
            $entityManager->flush();

            $this->addFlash('success', 'Catégorie de plat modifié :)');
            return $this->redirectToRoute('app_admin_category_meal');
        }

        return $this->render('admin/pictures/addPicture.html.twig', [
            'categoryMealForm' => $form->createView(),
        ]);
    }
}
