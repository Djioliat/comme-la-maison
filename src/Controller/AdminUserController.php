<?php

namespace App\Controller;


use App\Repository\UserRepository;
use Doctrine\Common\Collections\Expr\Value;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_users_index")
     */
    public function index(UserRepository $repo): Response
    {
        // Permet de formater date en string
        $user = $repo->findAll();

        foreach ($user as $value) {
            $anniversaire = $value->getAnniversaire();

            $date = $anniversaire->format('d-m-Y');
        }
        return $this->render('admin/users/index.html.twig', [
            'users' => $repo->findAll(),
            'date' => $date

        ]);
    }
}
