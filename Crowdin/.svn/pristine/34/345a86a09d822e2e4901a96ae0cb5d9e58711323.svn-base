<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Langage;
use App\Entity\User;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    { 
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/user", name="user")
     */
    public function user()
    {
        /*

        $user = $this->getUser();
  
        // On crée la langue
        $langueAng = $this->getDoctrine()
            ->getRepository(Langage::class)
            ->find(1);

        $langueEsp = $this->getDoctrine()
            ->getRepository(Langage::class)
            ->find(4);

        $user->addLangage($langueAng);
        $user->addLangage($langueEsp);
  
        // On la persiste
        $manager = $this->getDoctrine()->getManager();
        $manager->flush();

        
        return new Response(
            'Saved user with id: '.$user->getUsername()
            .' and new langages : '.var_dump($this->getUser())
        );

        */
        return $this->render('user/index.html.twig');
    }
}
