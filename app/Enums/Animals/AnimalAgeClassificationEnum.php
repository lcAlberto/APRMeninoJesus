<?php

namespace App\Enums\Animals;

use App\Enums\Enum;

abstract class AnimalAgeClassificationEnum extends Enum
{
    const HEIFER = 'heifer';//novilha
    const BABY_COW = 'baby-cow';//Bezerra
    const ADULT_COW = 'adult-cow';//Vaca Adulta

    const REPRODUCTIVE_BULL = 'reproductive-bull';//Touro
    const CASTRATED_BULL = 'castrated-bull';//Capão
    const RUFFIAN_BULL = 'ruffian-bull';//Rufião
    const BULL_BULL = 'baby-bull';//Bezerro
}