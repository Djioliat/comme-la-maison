<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdminUserType;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Expr\Value;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

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
    /**
     * Modifier rôle utilisateurs
     *
     * @Route("/admin/user/modifier/{id}", name="admin_edit_user")
     */
    public function editUser(User $user, Request $request) {
        $form = $this->createForm(AdminUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Modification bien enregistrer');
            return $this->redirectToRoute('admin_users_index');
        }
        return $this->render('admin/users/edituser.html.twig', [
            'userForm' => $form->createView()
        ]);
    }
}
