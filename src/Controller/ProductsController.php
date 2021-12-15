<?php

namespace App\Controller;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductsController extends AbstractController
{

    private $entitymanager;
    public function __construct(EntityManagerInterface  $entityManager){
        $this->EntityManager = $entityManager;
    }
    #[Route('/Nos-produits', name: 'products')]
    public function index(): Response
    {
        $products = $this->EntityManager->getRepository(Product::class)->FindAll();
        return $this->render('products/index.html.twig',[
            'products' => $products 
        ]);
    }
    #[Route('/produit/{slug}', name: 'product')]
    public function show($slug): Response
    {

        $product = $this->EntityManager->getRepository(Product::class)->findOneByslug($slug);
        if(!$product){
            return $this->redirectToRoute('products');
        }
        return $this->render('products/show.html.twig',[
            'products' => $product 
        ]);
    }
}
