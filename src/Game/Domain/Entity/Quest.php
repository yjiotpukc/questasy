<?php

declare(strict_types=1);

namespace Game\Domain\Entity;

use Game\Domain\Entity\Condition\Condition;
use Game\Domain\Entity\QuestAction\QuestAction;
use Game\Domain\Entity\QuestStage\QuestStage;
use LogicException;

/**
 * @property-read string $title
 * @property-read string $description
 * @property-read QuestStage $startingStage
 */
class Quest
{
    protected string $title;
    protected string $description;
    protected QuestStage $startingStage;
    /** @var QuestStage[] */
    protected array $stages;
    /** @var QuestAction[] */
    protected array $actions;
    /** @var Condition[] */
    protected array $conditions;

    public function start(): WalkthroughQuest
    {
        return new WalkthroughQuest($this);
    }

    public function isAvailable(GameStatus $gameStatus): bool
    {
        foreach ($this->conditions as $condition) {
            if (!$condition->test($gameStatus)) {
                return false;
            }
        }

        return true;
    }

    public function __get(string $name)
    {
        return match ($name) {
            'title' => $this->title,
            'description' => $this->description,
            'startingStage' => $this->startingStage,
            default => throw new LogicException(static::class . ' does not have property ' . $name),
        };
    }
}
