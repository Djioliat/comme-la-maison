<?php

namespace App\Controller;

use App\Entity\Commandes;
use App\Form\CommandeType;
use App\Service\Cart\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(CartService $cartService, Request $request): Response
    {
        $commande = new Commandes();
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $commande->setValeur("false");
            $entityManager->persist($commande);
            $entityManager->flush();
        }

        return $this->render('cart/index.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal()/100,
            'form' => $form->createView(),

            
        ]);
    }
    
    /**
     * Ajout pour la commande
     * @Route("/panier/add/{id}", name="cart_add")
     * @return void
     */
    public function add($id, CartService $cartService) {

        $cartService->add($id);
        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartService) {
        
        $cartService->remove($id);
        return $this->redirectToRoute("cart_index");
    }
    
    /**
     * @Route("/success", name="success")
     */
    public function success(CartService $cartService, Session $session) {
        dump( $session->get("toto"));
        return $this->render('/cart/success.html.twig');
    }

    /**
     * @Route("/error", name="error")
     */
    public function error() {
        return $this->render('/cart/error.html.twig');  
    }

    /**
     * @Route("/create-checkout-session", name="validation")
     */
    public function validation(CartService $cartService, Session $sessionTest) {
        \Stripe\Stripe::setApiKey('sk_test_51I55RjISe9AQaCmEogow1E8hx0jaA8ERZVmWThn8DEDrnS1PgXmT9bUHkOFzTpJeUxn1toGQ6qPE4i8ENkfjDxSM00WYrfIdei');
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                  'name' => 'Commande',

                ],
                'unit_amount' => $cartService->getTotal(),
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('error', [], UrlGeneratorInterface::ABSOLUTE_URL),
          ]); 
          $sessionTest->set("toto","lastico");
          return new JsonResponse([ 'id' => $session->id ]);
    }
}
