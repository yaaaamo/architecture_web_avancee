<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CalculController extends AbstractController
{
    #[Route('/calcul', name: 'calcul')]
    public function index(Request $request): Response
    {
        $n = $request->query->get('n');
        $p = $request->query->get('p');

        // Aucun paramètre → template de base
        if ($n === null) {
            return $this->render('base.html.twig');
        }

        $n = (int) $n;

        // Factorielle
        if ($p === null) {
            $r = 1;
            for ($i = 1; $i <= $n; $i++) {
                $r *= $i;
            }

            return $this->render('calcul/factocombi.html.twig', [
                'n' => $n,
                'r' => $r,
            ]);
        }

        // Combinaisons
        $p = (int) $p;

        $fact = fn($x) => array_product(range(1, max(1, $x)));
        $r = $fact($n) / ($fact($p) * $fact($n - $p));

        return $this->render('calcul/factocombi.html.twig', [
            'n' => $n,
            'p' => $p,
            'r' => $r,
        ]);
    }
}

