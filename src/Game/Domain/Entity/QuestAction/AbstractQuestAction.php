<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestAction;

use Game\Domain\Entity\Condition\Condition;
use Game\Domain\Entity\GameStatus;

abstract class AbstractQuestAction implements QuestAction
{
    protected ?Condition $visibilityCondition;
    protected ?Condition $availabilityCondition;

    public function canShow(GameStatus $gameStatus): bool
    {
        return !$this->visibilityCondition || $this->visibilityCondition->test($gameStatus);
    }

    public function isAvailable(GameStatus $gameStatus): bool
    {
        return !$this->availabilityCondition || $this->availabilityCondition->test($gameStatus);
    }
}
