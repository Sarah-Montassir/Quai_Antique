<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('', name: 'app_admin')]
    public function adminHome(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/pictures', name: 'app_get_admin_pictures')]
    public function adminGetPictures(PictureRepository $pictureRepository): Response
    {
        $pictures = $pictureRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'pictures' => $pictures,
        ]);
    }

    #[Route('/pictures/add', name: 'app_add_admin_pictures')]
    public function adminAddPictures(Request $request, EntityManagerInterface $entityManager): Response
    {
        $picture = new Picture();
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!$photo = $form->get('picture')->getData()){

                $nomPhoto = $photo->getClientOriginalName();
                $photo->move($this->getParameter('upload_directory'), $nomPhoto);
                $picture->setPictureName($nomPhoto);

                $entityManager->persist($picture);

            }
            $this->addFlash('success', 'Image ajoutée :)');
            $entityManager->flush();
            return  $this->redirectToRoute('app_get_admin_pictures');
        }

        return $this->render('admin/addPicture.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    #[Route('/pictures/display/{id}')]
    public function changeStatePicture($id, EntityManagerInterface $entityManager, PictureRepository $pictureRepository): Response
    {
        $picture = $pictureRepository->find($id);
        $picture->setIsDisplayed(!$picture->isDisplayed());
        $entityManager->flush();

        return $this->redirectToRoute('app_get_admin_pictures');
    }

    #[Route('/pictures/delete/{id}', name: 'app_delete_admin_pictures')]
    public function adminDeletePictures($id, EntityManagerInterface $entityManager, PictureRepository $pictureRepository): Response
    {
        $picture = $pictureRepository->find($id);
        $entityManager->remove($picture);
        $entityManager->flush();

        return $this->redirectToRoute('app_get_admin_pictures');
    }
}