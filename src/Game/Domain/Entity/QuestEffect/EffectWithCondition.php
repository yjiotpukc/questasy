<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestEffect;

use Game\Domain\Entity\Condition\Condition;
use Game\Domain\Entity\GameStatus;

class EffectWithCondition implements QuestEffect
{
    protected Condition $condition;
    protected QuestEffect $effect;

    public function receive(GameStatus $gameStatus): void
    {
        if ($this->condition->test($gameStatus)) {
            $this->effect->receive($gameStatus);
        }
    }
}
