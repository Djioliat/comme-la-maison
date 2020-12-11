<?php

namespace App\Controller;

use App\Entity\Menu;
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
        $menus = $this->getDoctrine()
             ->getRepository(Menu::class)
             ->findAll();

        return $this->render('menu/index.html.twig', [
            'menus' => $menus
        ]);
    }
}
