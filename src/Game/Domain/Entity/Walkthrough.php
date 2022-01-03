<?php

declare(strict_types=1);

namespace Game\Domain\Entity;

use Game\Domain\Entity\QuestAction\QuestAction;
use LogicException;

/**
 * @property-read ?WalkthroughQuest $currentQuest
 * @property-read WalkthroughQuest[] $questHistory
 * @property-read Quest[] $availableQuests
 * @property-read GameStatus $gameStatus
 */
class Walkthrough
{
    protected ?WalkthroughQuest $currentQuest;
    /** @var WalkthroughQuest[] */
    protected array $questHistory;
    /** @var Quest[] */
    protected array $availableQuests;
    protected GameStatus $gameStatus;

    public function startQuest(Quest $quest): void
    {
        $this->currentQuest = $quest->start();
    }

    public function finishQuest(): void
    {
        $this->questHistory[] = $this->currentQuest;
        $this->currentQuest = null;
    }

    public function progress(QuestAction $questAction): void
    {
        $this->currentQuest->progress($questAction, $this->gameStatus);
    }

    /**
     * @param Quest[] $possibleQuests
     */
    public function updatePossibleQuests(array $possibleQuests): void
    {
        $this->availableQuests = array_filter($possibleQuests, fn($quest) => $quest->isAvailable($this->gameStatus));
    }

    public function __get(string $name)
    {
        return match ($name) {
            'currentQuest' => $this->currentQuest,
            'questHistory' => $this->questHistory,
            'availableQuests' => $this->availableQuests,
            'gameStatus' => $this->gameStatus,
            default => throw new LogicException(static::class . ' does not have property ' . $name),
        };
    }
}
