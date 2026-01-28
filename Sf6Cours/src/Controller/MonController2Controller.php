<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MonController2Controller extends AbstractController
{
    #[Route('/add/{x}/{y}', name: 'add')]
    public function add(int $x, int $y): Response
    {
        $sum = $x + $y;

        return new Response("Result: $sum");
    }
}
