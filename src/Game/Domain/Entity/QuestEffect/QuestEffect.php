<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestEffect;

use Game\Domain\Entity\GameStatus;

interface QuestEffect
{
    public function receive(GameStatus $gameStatus): void;
}
