<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class CartController extends AbstractController

{
    private $EntityManager;
    public function __construct(EntityManagerInterface $EntityManager ){
        $this->EntityManager = $EntityManager;
    }
    #[Route('/mon-panier', name: 'cart')]
    public function index(Cart $cart): Response
    {   
        $cartComplete = [];
        foreach($cart->get() as $id => $quantity){
            $cartComplete[] = [
                'product' => $this->EntityManager->getRepository(Product::class)->findOneById($id),
                'quantity' => $quantity
            ];
        }

        return $this->render('cart/index.html.twig', ['cart'=>$cartComplete
    ]);
    }

    #[Route('/cart/add/{id}', name: 'add_to_cart')]
    public function add(Cart $cart, $id): Response
    {
    
        $cart->add($id);
        return $this->redirectToRoute('cart');
    }
      #[Route('/cart/remove', name: 'remove_cart')]
    public function remove(Cart $cart): Response
    {
    
        $cart->remove();
        return $this->redirectToRoute('products');
    }
    #[Route('/cart/delete/{id}', name: 'delete_cart')]
    public function delete(Cart $cart,$id): Response
    {
    
        $cart->delete($id);
        return $this->redirectToRoute('cart');
    }
}