<?php

namespace App\Controller;


use App\Repository\BarRepository;
use App\Repository\MenuRepository;
use App\Repository\WineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\FoodRepository;
use App\Repository\RestaurantRepository;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    /**
     * @Route("/", name="homepage")
     */
    public function home(FoodRepository $foodRepository, WineRepository $wineRepository, MenuRepository $menuRepository, RestaurantRepository $restaurantRepository, BarRepository $barRepository) {
        return $this->render('home.html.twig', [
            'foods' => $foodRepository->findAll(),
            'wines' => $wineRepository->findAll(),
            'menus' => $menuRepository->findAll(),
            'coordonnees' => $restaurantRepository->findOne(),
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