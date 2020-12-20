<?php

namespace App\Controller;

use App\Entity\Wine;
use App\Form\WineType;
use App\Repository\WineRepository;
use Intervention\Image\ImageManagerStatic;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("admin/wine")
 */
class AdminWineController extends AbstractController
{
    /**
     * @Route("/", name="wine_index", methods={"GET"})
     */
    public function index(WineRepository $wineRepository): Response
    {
        return $this->render('wine/index.html.twig', [
            'wines' => $wineRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="wine_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $wine = new Wine();
        $form = $this->createForm(WineType::class, $wine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //            Récupérer l'image
            $image = $form->get('picture')->getData();
//            Générer un nom de fichier lié au vin
            $fichier = $wine->getNameCuvee() . '.' . $image->guessExtension();
//            Copie du fichier dans le dossier upload
            $image->move(
                $this->getParameter('images_directory'),
                $fichier
            );
//            Redimensionner l'image
            $resizedImage = ImageManagerStatic::make($this->getParameter('images_directory') . $fichier);
//            Fit centre et coupe l'image
            $resizedImage->fit(750,560);
//            resize déforme l'image aux proportions demandées
//            $resizedImage->resize(750,560);
            $resizedImage->response('jpg',100);
//            Copie du fichier dans le dossier upload
            $resizedImage->save($this->getParameter('images_directory') . $fichier);

            $wine->setPicture($fichier);
            $wine->setImageDescription($wine->getNameCuvee());


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($wine);
            $entityManager->flush();

            return $this->redirectToRoute('wine_index');
        }

        return $this->render('wine/new.html.twig', [
            'wine' => $wine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="wine_show", methods={"GET"})
     */
    public function show(Wine $wine): Response
    {
        return $this->render('wine/show.html.twig', [
            'wine' => $wine,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="wine_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Wine $wine): Response
    {
        $form = $this->createForm(WineType::class, $wine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('picture')->getData();
//            Générer un nom de fichier lié au vin
            $fichier = $wine->getNameCuvee() . '.' . $image->guessExtension();
//            Copie du fichier dans le dossier upload
            $image->move(
                $this->getParameter('images_directory'),
                $fichier
            );
//            Redimensionner l'image
            $resizedImage = ImageManagerStatic::make($this->getParameter('images_directory') . $fichier);
//            Fit centre et coupe l'image
            $resizedImage->fit(750,560);
//            resize déforme l'image aux proportions demandées
//            $resizedImage->resize(750,560);
            $resizedImage->response('jpg',100);
//            Copie du fichier dans le dossier upload
            $resizedImage->save($this->getParameter('images_directory') . $fichier);

            $wine->setPicture($fichier);
            
            $wine->setImageDescription($wine->getNameCuvee());
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wine_index');
        }

        return $this->render('wine/edit.html.twig', [
            'wine' => $wine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="wine_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Wine $wine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$wine->getId(), $request->request->get('_token'))) {
//            Supprimer physiquement l'image du dossier upload
            unlink($this->getParameter('images_directory').'/'.$wine->getPicture());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($wine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('wine_index');
    }
}
