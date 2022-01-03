<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestEffect;

use Game\Domain\Entity\GameStatus;

class QuestEffectGiveMoney implements QuestEffect
{
    protected int $amount;

    public function receive(GameStatus $gameStatus): void
    {
        $gameStatus->addMoney($this->amount);
    }
}
