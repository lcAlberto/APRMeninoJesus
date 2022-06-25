<?php

namespace App\Enums\Animals;

use App\Enums\Enum;

abstract class AnimalProductionStatus extends Enum
{
    const DRY = 'dry';//Seca
    const LACTATING = 'lactating';//Lactante
    const NO_LACTATING = 'non lactating';//Não Lactante
    const PREGNANT = 'pregnant';//Prenha

    const BULL_REPRODUCTIVE = 'bull-reproductive';//Touro
    const BULL_CASTRATED = 'bull-castrated';//Capão
    const BULL_RUFFIAN = 'bull-ruffian';//Rufião
}