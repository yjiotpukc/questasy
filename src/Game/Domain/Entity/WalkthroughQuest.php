<?php

declare(strict_types=1);

namespace Game\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Game\Domain\Entity\QuestAction\QuestAction;
use Game\Domain\Entity\QuestStage\QuestStage;
use LogicException;

/**
 * @property-read string $title
 * @property-read string $description
 * @property-read QuestStage $stage
 * @property-read Collection<int, QuestStage> $stageHistory
 * @property-read Collection<int, QuestAction> $possibleActions
 */
class WalkthroughQuest
{
    protected string $title;
    protected string $description;
    /** @var Collection<int, QuestStage> */
    protected Collection $stages;
    /** @var Collection<int, QuestAction> */
    protected Collection $actions;

    protected string $currentStageId;
    /** @var Collection<int, QuestStage> */
    protected Collection $stageHistory;

    public function __construct(Quest $quest)
    {
        $this->title = $quest->title;
        $this->description = $quest->description;
        $this->stages = $quest->stages;
        $this->actions = $quest->actions;

        $this->currentStageId = $quest->startingStageId;
        $this->stageHistory = new ArrayCollection([$this->stage]);
    }

    public function progress(string $questActionId, GameStatus $gameStatus): void
    {
        $questAction = $this->actions->filter(fn (QuestAction $action) => $action->id === $questActionId)->first();
        $this->currentStageId = $questAction->nextStage($gameStatus);

        $currentStage = $this->stages->filter(fn (QuestStage $stage) => $stage->id === $this->currentStageId)->first();
        $this->stageHistory[] = $currentStage;
        $currentStage->receiveEffects($gameStatus);
    }

    public function __get(string $name)
    {
        return match ($name) {
            'title' => $this->title,
            'description' => $this->description,
            'stage' => $this->stages->filter(fn (QuestStage $stage) => $stage->id === $this->currentStageId)->first(),
            'stageHistory' => $this->stageHistory,
            'possibleActions' => $this->actions->filter(fn (QuestAction $action) => in_array($action->id, $this->stage->actions, true)),
            default => throw new LogicException(static::class . ' does not have property ' . $name),
        };
    }

    public function __isset(string $name)
    {
        return in_array($name, ['title', 'description', 'stage', 'stageHistory', 'possibleActions']);
    }
}
