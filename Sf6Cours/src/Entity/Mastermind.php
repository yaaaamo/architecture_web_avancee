<?php

namespace App\Entity;
use App\Service\iMastermind;

class Mastermind implements iMastermind
{
    private int $taille;
    private string $secret;
    private array $essais = []; 

    public function __construct($taille = 4)
    {
        $this->taille = $taille;
        $this->secret = $this->generateSecret($taille);
    }

    public function getTaille(): int { return $this->taille; }
    public function getEssais(): array { return $this->essais; }

    public function isFini(): bool
    {
        if (empty($this->essais)) return false;
        $last = $this->essais[array_key_last($this->essais)];
        return $last['bien'] === $this->taille;
    }

    public function test($code): bool
    {
        $code = trim($code);

        // validation : exactement 4 chiffres
        if (strlen($code) !== $this->taille) return false;
        if (!ctype_digit($code)) return false;

        // chiffres différents (contrainte de l'énoncé)
        if (count(array_unique(str_split($code))) !== $this->taille) return false;

        [$bien, $mal] = $this->compare($code);

        $this->essais[] = [
            'code' => $code,
            'bien' => $bien,
            'mal'  => $mal,
        ];

        return true;
    }

    private function generateSecret($taille): string
    {
        $digits = range(0, 9);
        shuffle($digits);
        return implode('', array_slice($digits, 0, $taille));
    }

    private function compare($code): array
    {
        $secretArr = str_split($this->secret);
        $codeArr   = str_split($code);

        $bien = 0;
        for ($i = 0; $i < $this->taille; $i++) {
            if ($codeArr[$i] === $secretArr[$i]) $bien++;
        }

        // tous différents => mal = commun - bien
        $totalPresent = count(array_intersect($codeArr, $secretArr));
        $mal = $totalPresent - $bien;

        return [$bien, $mal];
    }
}
