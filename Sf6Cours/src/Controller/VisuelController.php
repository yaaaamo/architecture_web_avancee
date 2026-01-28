<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VisuelController extends AbstractController
{
   #[Route('/visuel', name: 'visuel')]
    public function index(): Response
    {
        return $this->render('visuel/index.html.twig', [
            'titre' => 'Mon premier rendu visuel',
            'liste' => ['Michel', 'Meynard'],
        ]);
    }

}
