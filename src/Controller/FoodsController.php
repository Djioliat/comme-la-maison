<?php

namespace App\Controller;

use App\Entity\Food;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FoodsController extends AbstractController
{
    /**
     * @Route("/plats", name="food_index")
     */
    public function index(): Response
    {
        $foods = $this->getDoctrine()
             ->getRepository(Food::class)
             ->findAll();

        return $this->render('foods/index.html.twig', [
            'foods' => $foods
        ]);
    }
}
