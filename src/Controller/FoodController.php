<?php

namespace App\Controller;
use App\Entity\Food;
use App\Form\FoodType;
use App\Repository\FoodRepository;
use Intervention\Image\ImageManagerStatic;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/plat")
 */
class FoodController extends AbstractController
{
    /**
     * @Route("/", name="food_index", methods={"GET"})
     */
    public function index(FoodRepository $foodRepository): Response
    {
        return $this->render('food/index.html.twig', [
            'food' => $foodRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="food_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $food = new Food();
        $form = $this->createForm(FoodType::class, $food);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            Récupérer l'image
            $image = $form->get('picture')->getData();
//            Générer un nom de fichier lié au plat
            $fichier = $food->getName() . '.' . $image->guessExtension();

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


//            Stoker l'image en base de donnée via l'entité Food
            $food->setPicture($fichier);
            $food->setImageDescription($food->getName());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($food);
            $entityManager->flush();

            return $this->redirectToRoute('food_index');
        }

        return $this->render('food/new.html.twig', [
            'food' => $food,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="food_show", methods={"GET"})
     */
    public function show(Food $food): Response
    {
        return $this->render('food/show.html.twig', [
            'food' => $food,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="food_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Food $food): Response
    {
        $form = $this->createForm(FoodType::class, $food);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            Récupérer l'image
            if ($form->get('picture')->getData() != null){
                $image = $form->get('picture')->getData();
//            Générer un nom de fichier unique
                $fichier = $food->getName() . '.' . $image->guessExtension();
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
//            $resizedImage->resize(750,560);                $resizedImage->response('jpg',100);
//            Copie du fichier dans le dossier upload
                $resizedImage->save($this->getParameter('images_directory') . $fichier);
//            Stoker l'image en base de donnée via l'entité Food
                $food->setPicture($fichier);
            }else{
                $food->setPicture($food->getPicture());
            }



            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('food_index');
        }

        return $this->render('food/edit.html.twig', [
            'food' => $food,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="food_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Food $food): Response
    {
        if ($this->isCsrfTokenValid('delete'.$food->getId(), $request->request->get('_token'))) {
//            Supprimer physiquement l'image du dossier upload
            unlink($this->getParameter('images_directory').'/'.$food->getPicture());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($food);
            $entityManager->flush();
        }

        return $this->redirectToRoute('food_index');
    }
}
