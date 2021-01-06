<?php

namespace App\Controller;

use App\Entity\Bar;
use App\Form\BarType;
use App\Repository\BarRepository;
use Intervention\Image\ImageManagerStatic;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminBarController extends AbstractController
{
    /**
     * @Route("/admin/bar", name="admin_bar", methods={"GET"})
     */
    public function index(BarRepository $barRepository): Response
    {
        return $this->render('admin_bar/index.html.twig', [
            'bars' => $barRepository->findAll(),
        ]);
    }
    /**
     * Ajout d'une boisson
     *
     * @Route("/admin/bar/new", name="bar_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bar = new Bar();
        $form = $this->createForm(BarType::class, $bar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            //image
            $image = $form->get('picture')->getData();
            // Générer un nom de fichier lié à la boisson
            $fichier = $bar->getName() . '.' . $image->guessExtension();
            // Copie du fichier dans le dossier upload
            $image->move(
                $this->getParameter('images_directory'),
                $fichier
            );
            // Redimensionner l'image
            $resizedImage = ImageManagerStatic::make($this->getParameter('images_directory') . $fichier);
            // Fit centre et coupe l'image
            $resizedImage->fit(750,560);
            // resize déforme l'image aux proportions demandées
            // $resizedImage->resize(750,560);
            $resizedImage->response('jpg',100);
            // Copie du fichier dans le dossier upload
            $resizedImage->save($this->getParameter('images_directory') . $fichier);

            $bar->setPicture($fichier);
            $bar->setImageDescription($bar->getName());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bar);
            $entityManager->flush();

            return $this->redirectToRoute('admin_bar');
        }

        return $this->render('admin_bar/new.html.twig', [
            'bars' => $bar,
            'form' => $form->createView(),
        ]);
    }
}
