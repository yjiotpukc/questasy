<?php

declare(strict_types=1);

namespace Game\Domain\Entity;

use Doctrine\Common\Collections\Collection;
use Game\Domain\Entity\Condition\Condition;
use Game\Domain\Entity\QuestAction\QuestAction;
use Game\Domain\Entity\QuestStage\QuestStage;
use LogicException;

/**
 * @property-read string $id
 * @property-read string $title
 * @property-read string $description
 * @property-read string $startingStageId
 * @property-read Collection<int, QuestStage> $stages
 * @property-read Collection<int, QuestAction> $actions
 */
class Quest
{
    protected string $id;
    protected string $title;
    protected string $description;
    protected string $startingStageId;
    /** @var Collection<int, QuestStage> */
    protected Collection $stages;
    /** @var Collection<int, QuestAction> */
    protected Collection $actions;
    /** @var Collection<int, Condition> */
    protected Collection $conditions;

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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'startingStageId' => $this->startingStageId,
            'stages' => $this->stages,
            'actions' => $this->actions,
            default => throw new LogicException(static::class . ' does not have property ' . $name),
        };
    }

    public function __isset(string $name)
    {
        return in_array($name, ['id', 'title', 'description', 'startingStageId', 'stages', 'actions']);
    }
}
