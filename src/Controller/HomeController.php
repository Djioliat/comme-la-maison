<?php

namespace App\Controller;

use App\Repository\BarRepository;
use App\Repository\WineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\FoodRepository;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    /**
     * @Route("/", name="homepage")
     */
    public function home(FoodRepository $foodRepository, WineRepository $wineRepository, BarRepository $barRepository) {
        return $this->render('home.html.twig', [
            'foods' => $foodRepository->findAll(),
            'wines' => $wineRepository->findAll(),
            'bars' => $barRepository->findAll()
        ]);
    }
    /**
     * @Route("/admin", name="adminpage")
     */
    public function admin() {
        return $this->render('admin.html.twig');
    }

}
?>