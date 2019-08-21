<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function Registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user=new User();
        $form= $this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $hash=$encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute("security_connection");

        }
        return $this->render("security/registration.html.twig",[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/connection", name="security_connection")
     */
    public function login()
    {
        return $this->render("security/login.html.twig");
    }
    /**
     * @Route("/deconnection", name="security_deconnection")
     */
    public function logout()
    {
        return $this->render("security/login.html.twig");
    }

}
