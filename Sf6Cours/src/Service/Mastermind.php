<?php
// src/Service/Mastermind.php
namespace App\Service;

class Mastermind
{
    private int $taille;
    private string $secret;
    /** @var array<int, array{code:string,bien:int,mal:int}> */
    private array $essais = [];

    public function __construct(int $taille = 4)
    {
        $this->taille = $taille;
        $this->secret = $this->generateSecret($taille);
    }

    public function getTaille(): int
    {
        return $this->taille;
    }

    /** @return array<int, array{code:string,bien:int,mal:int}> */
    public function getEssais(): array
    {
        return $this->essais;
    }

    public function isFini(): bool
    {
        if (empty($this->essais)) {
            return false;
        }
        $last = $this->essais[array_key_last($this->essais)];
        return $last['bien'] === $this->taille;
    }

    /**
     * Teste une proposition.
     * Retourne true si proposition valide (ajoutée à l'historique), false sinon.
     */
    public function test(string $code): bool
    {
        $code = trim($code);

        // longueur + uniquement chiffres
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

    private function generateSecret(int $taille): string
    {
        $digits = range(0, 9);
        shuffle($digits);
        return implode('', array_slice($digits, 0, $taille));
    }

    /** @return array{0:int,1:int} */
    private function compare(string $code): array
    {
        $secretArr = str_split($this->secret);
        $codeArr   = str_split($code);

        $bien = 0;
        for ($i = 0; $i < $this->taille; $i++) {
            if ($codeArr[$i] === $secretArr[$i]) {
                $bien++;
            }
        }

        // chiffres tous différents => mal placés = commun - bien placés
        $totalPresent = count(array_intersect($codeArr, $secretArr));
        $mal = $totalPresent - $bien;

        return [$bien, $mal];
    }
}
