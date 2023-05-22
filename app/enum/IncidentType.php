<?php

namespace App\enum;

enum IncidentType: string
{
    use EnumToArray;

    case Incendie = 'Incendie';
    case AccidentRoutier = 'Accident routier';
    case AccidentFluviale = 'Accident fluviale';
    case AccidentAérien = 'Accident aérien';
    case Eboulement = 'Eboulement';
    case InvasionDeSerpent = 'Invasion de serpent';
    case FuiteDeGaz = 'Fuite de gaz';
    case Manifestation = 'Manifestation';
    case Braquage = 'Braquage';
    case EvasionDunPrisonnier = 'Evasion d’un prisonnier';
}
