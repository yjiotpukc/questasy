<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestStage;

use Game\Domain\Entity\Condition\Condition;
use LogicException;

/**
 * @property-read QuestStage $questStage
 * @property-read Condition $condition
 */
class QuestStageWithCondition
{
    protected QuestStage $questStage;
    protected Condition $condition;

    public function __get(string $name)
    {
        return match ($name) {
            'questStage' => $this->questStage,
            'condition' => $this->condition,
            default => throw new LogicException(static::class . ' does not have property ' . $name),
        };
    }
}
