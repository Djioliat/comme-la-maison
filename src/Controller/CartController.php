<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(CartService $cartService): Response
    {
        return $this->render('cart/index.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal()/100
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
    public function success() {
        
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
    public function validation(CartService $cartService) {
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
          return new JsonResponse([ 'id' => $session->id ]);
    }
}
