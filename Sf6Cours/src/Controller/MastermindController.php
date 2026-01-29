<?php

namespace App\Controller;

use App\Entity\Mastermind;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MastermindController extends AbstractController
{
    #[Route('/master', name: 'master')]
    public function master(Request $request): Response
    {
        $session = $request->getSession();

        // reset
        if ($request->query->get('new')) {
            $session->remove('mastermind');
        }

        $game = $session->get('mastermind');

        // si pas de jeu en session => on crée
        if (!$game instanceof Mastermind) {
            $game = new Mastermind(4);
            $session->set('mastermind', $game);
        }

        $message = null;

        // proposition
        $code = $request->query->get('code');
        if ($code !== null && $code !== '') {
            if (!$game->test((string)$code)) {
                $message = "Veuillez saisir une proposition valide (4 chiffres différents).";
            }
            $session->set('mastermind', $game);
        }

        return $this->render('mastermind\mastermind.html.twig', [
            'taille'  => $game->getTaille(),
            'essais'  => $game->getEssais(),
            'fini'    => $game->isFini(),
            'message' => $message,
        ]);
    }
}
