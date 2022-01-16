<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestAction;

use Game\Domain\Entity\Condition\Condition;
use Game\Domain\Entity\GameStatus;
use LogicException;

abstract class AbstractQuestAction implements QuestAction
{
    protected string $id;
    protected string $text;
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

    public function __get(string $name)
    {
        return match ($name) {
            'id' => $this->id,
            'text' => $this->text,
            default => throw new LogicException(static::class . ' does not have property ' . $name),
        };
    }

    public function __isset(string $name): bool
    {
        return in_array($name, ['id', 'text']);
    }
}
