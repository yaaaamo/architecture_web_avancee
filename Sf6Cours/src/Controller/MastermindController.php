<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MastermindController extends AbstractController
{
    #[Route('/mastermind', name: 'app_mastermind')]
    public function index(): Response
    {
        return $this->render('mastermind/index.html.twig', [
            'controller_name' => 'MastermindController',
        ]);
    }
}
