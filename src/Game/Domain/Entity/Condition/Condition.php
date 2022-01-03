<?php

declare(strict_types=1);

namespace Game\Domain\Entity\Condition;

use Game\Domain\Entity\GameStatus;

interface Condition
{
    public function test(GameStatus $gameStatus): bool;
}
