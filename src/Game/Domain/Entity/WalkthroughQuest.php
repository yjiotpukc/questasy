<?php

declare(strict_types=1);

namespace Game\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Game\Domain\Entity\QuestAction\QuestAction;
use Game\Domain\Entity\QuestStage\QuestStage;
use LogicException;

class WalkthroughQuest
{
    protected string $title;
    protected string $description;
    /** @var Collection<int, QuestStage> */
    protected Collection $stages;
    /** @var Collection<int, QuestAction> */
    protected Collection $actions;

    protected QuestStage $stage;
    /** @var Collection<int, QuestStage> */
    protected Collection $stageHistory;

    public function __construct(Quest $quest)
    {
        $this->title = $quest->title;
        $this->description = $quest->description;
        $this->stages = $quest->stages;
        $this->actions = $quest->actions;

        $this->stage = $quest->startingStage;
        $this->stageHistory = new ArrayCollection([$this->stage]);
    }

    public function progress(string $questActionId, GameStatus $gameStatus): void
    {
        $questAction = $this->actions->filter(fn (QuestAction $action) => $action->id === $questActionId)->first();
        $nextStageId = $questAction->nextStage($gameStatus);
        $this->stage = $this->stages->filter(static fn (QuestStage $stage) => $stage->id === $nextStageId)->first();
        $this->stageHistory[] = $this->stage;
        $this->stage->receiveEffects($gameStatus);
    }

    public function __get(string $name)
    {
        return match ($name) {
            'title' => $this->title,
            'description' => $this->description,
            'stage' => $this->stage,
            'stageHistory' => $this->stageHistory,
            'possibleActions' => $this->actions->filter(fn (QuestAction $action) => in_array($action->id, $this->stage->actions, true)),
            default => throw new LogicException(static::class . ' does not have property ' . $name),
        };
    }
}
