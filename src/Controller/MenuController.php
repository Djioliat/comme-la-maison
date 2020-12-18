<?php

namespace App\Controller;

use App\Entity\Food;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    /**
     * @Route("/menus", name="menu_index")
     */
    public function index(): Response
    {
        $foods = $this->getDoctrine()
             ->getRepository(Food::class)
             ->findAll();

        return $this->render('menus/index.html.twig', [
            'foods' => $foods
        ]);
    }
}
