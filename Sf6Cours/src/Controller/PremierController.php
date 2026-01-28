<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PremierController extends AbstractController
{
    #[Route("/bonjour/{nom<[a-z]+>?toi}/{id<\d+>?13}")] public function bonjour($nom=null, $id=null) {
        if (!$nom){
        return new Response('Bonjour le monde !');
        } else {
        return new Response("Bonjour $nom d'id $id !");
        }
    }
    #[Route("/mult/{x<\d+>?1}/{y<\d+>?1}")] public function mult($x,$y){
        return new Response($x*$y); 
    }
    
}
