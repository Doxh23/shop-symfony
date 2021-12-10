<?php

namespace App\Controller;
use App\Form\ChangePasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;



class AccountPasswordController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/compte/password', name: 'account_password')]
    public function index(request $request, UserPasswordHasherInterface $encoder ): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class,$user);
        $form -> handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()){
            $old_pwd = $form->get('old_password')->getData();

             if($encoder->isPasswordValid($user,$old_pwd)){
                $new_pwd = $form->get('new_password')->getData();
                $password = $encoder->hashPassword($user,$new_pwd);
                $user->setPassword($password);
                $this-> entityManager->persist($user);
                $this->entityManager->flush();

            
             }else{
                 echo "it doesn't work";
             }


        }
        return $this->render('account/password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
