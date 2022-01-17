<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestStage;

use Game\Domain\Entity\Condition\Condition;
use LogicException;

/**
 * @property-read string $questStageId
 * @property-read Condition $condition
 */
class QuestStageWithCondition
{
    protected string $questStageId;
    protected Condition $condition;

    public function __get(string $name)
    {
        return match ($name) {
            'questStageId' => $this->questStageId,
            'condition' => $this->condition,
            default => throw new LogicException(static::class . ' does not have property ' . $name),
        };
    }

    public function __isset(string $name)
    {
        return in_array($name, ['questStageId', 'condition']);
    }
}
