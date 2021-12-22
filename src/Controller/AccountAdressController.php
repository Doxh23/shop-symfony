<?php

namespace App\Controller;

use App\Entity\Adress;
use App\Form\AdressType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class AccountAdressController extends AbstractController
{
    private $entityManager ;
    public function __construct(entityManagerInterface $entityManager){
            $this->entitymanager = $entityManager;
    }
    #[Route('/compte/adresses', name: 'account_adress')]
    public function index(): Response
    {
        return $this->render('account/adress.html.twig');
    }
    #[Route('/compte/adresses/ajoutez-une-adresse', name: 'account_adress_add')]
    public function Add(Request $request): Response
    {
        $adress = new Adress();
        $form = $this->createForm(AdressType::class,$adress);
        $form->handleRequest($request);
        if ($form ->isSubmitted() &&$form->isValid()){
            $adress->setUser($this->getUser());
        $this->entitymanager->persist($adress);
            $this->entitymanager->flush();
            return $this->redirectToRoute('account');

}
        return $this->render('account/adress_form.html.twig', [
            "form" =>$form->createView()
        ]);
    }



    #[Route('/compte/adresses/modifier-une-adresse/{id}', name: 'account_adress_edit')]
    public function edit(Request $request, $id): Response
    {
        $adress = $this->entitymanager->getRepository(Adress::class)->findOneById($id);
        if(!$adress || $adress->getUser() != $this->getUser()){
            return $this->redirectToRoute('account_adress');
        }
        $form = $this->createForm(AdressType::class,$adress);
        $form->handleRequest($request);
        if ($form ->isSubmitted() &&$form->isValid()){
            $this->entitymanager->flush();
            return $this->redirectToRoute('account');

}
        return $this->render('account/adress_form.html.twig', [
            "form" =>$form->createView()
        ]);
    }



    #[Route('/compte/adresses/supprimer-une-adresse/{id}', name: 'account_adress_delete')]
    public function delete(Request $request, $id): Response
    {
        $adress = $this->entitymanager->getRepository(Adress::class)->findOneById($id);
        if($adress && $adress->getUser() == $this->getUser()){
            $this->entitymanager->remove($adress);
            $this->entitymanager->flush();
        }

return $this->redirectToRoute('account_adress');

    }


}
