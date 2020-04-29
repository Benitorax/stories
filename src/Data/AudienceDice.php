<?php
namespace App\Manager;

class AudienceDice
{
    const BLACK_DICE = [
        "Ça c'est faux",
        "Moi ça me rappelle",
        "Avec du beurre ?",
        "Il était quelle heure ?",
        "T'oublie pas un détail ?",
        "C'est vrai, d'ailleurs",
        "J'ai pas compris",
        "Hop hop hop",
        "Et ton chien dans tout ça ?",
        "T'as pas eu trop peur ?",
        "Tu veux mon avis ?",
        "J'adore ce passage !", 
        "Ah bon ? Pourquoi ?",
        "Tu peux le prouver ?",
        "Ça me dégoute",
        "Je te comprends",
        "Certains doutent encore",
        "Le monde est d'accord",
        "C'était quel jour ?",
        "Tu nous cache la vérité",
        "Ton chat il en pense quoi ?"
    ];

    public function getOneSentence() {
        return self::BLACK_DICE[
            array_rand(self::BLACK_DICE, 1)
        ];
    }
}