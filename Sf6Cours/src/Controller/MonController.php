<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MonController extends AbstractController
{
    #[Route('/mon', name: 'app_mon')]
    public function index(): Response
    {
        return new Response("page d'accueil !");
    }
}
