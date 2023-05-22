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

#[Route('/admin/pictures')]
class AdminPictureController extends AbstractController
{

    #[Route('', name: 'app_get_admin_pictures')]
    public function adminGetPictures(PictureRepository $pictureRepository): Response
    {
        $pictures = $pictureRepository->findAll();

        return $this->render('admin/pictures/pictures.html.twig', [
            'pictures' => $pictures,
        ]);
    }

    #[Route('/add', name: 'app_add_admin_pictures')]
    public function adminAddPictures(Request $request, EntityManagerInterface $entityManager): Response
    {
        $picture = new Picture();
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            if ($photo = $form->get('picture')->getData()){

                $nomPhoto = $photo->getClientOriginalName();
                $photo->move($this->getParameter('upload_directory'), $nomPhoto);
                $picture->setPictureName($nomPhoto);

                $entityManager->persist($picture);

            }
            $this->addFlash('success', 'Image ajoutée :)');
            $entityManager->flush();
            return $this->redirectToRoute('app_get_admin_pictures');
        }

        return $this->render('admin/pictures/addPicture.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    #[Route('/display/{id}', name: 'app_hide_picture')]
    public function changeStatePicture($id, EntityManagerInterface $entityManager, PictureRepository $pictureRepository): Response
    {
        $picture = $pictureRepository->find($id);
        $picture->setIsDisplayed(!$picture->isIsDisplayed());
        $entityManager->flush();

        return $this->redirectToRoute('app_get_admin_pictures');
    }

    #[Route('/delete/{id}', name: 'app_delete_admin_pictures')]
    public function adminDeletePictures($id, EntityManagerInterface $entityManager, PictureRepository $pictureRepository): Response
    {
        $picture = $pictureRepository->find($id);
        unlink($this->getParameter('upload_directory').'/'.$picture->getPictureName());
        $entityManager->remove($picture);
        $entityManager->flush();

        return $this->redirectToRoute('app_get_admin_pictures');
    }
}
