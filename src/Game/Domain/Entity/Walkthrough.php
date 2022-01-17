<?php

declare(strict_types=1);

namespace Game\Domain\Entity;

use Doctrine\Common\Collections\Collection;
use Exception;
use Game\Domain\Exception\AvailableQuestNotFoundException;
use LogicException;

/**
 * @property-read ?WalkthroughQuest $currentQuest
 * @property-read Collection<int, WalkthroughQuest> $questHistory
 * @property-read Collection<int, Quest> $availableQuests
 * @property-read GameStatus $gameStatus
 */
class Walkthrough
{
    protected string $id;
    protected ?WalkthroughQuest $currentQuest = null;
    /** @var Collection<int, WalkthroughQuest> */
    protected Collection $questHistory;
    /** @var Collection<int, Quest> */
    protected Collection $availableQuests;
    protected GameStatus $gameStatus;

    /**
     * @throws Exception
     */
    public function startQuest(string $questId): void
    {
        foreach ($this->availableQuests as $quest) {
            if ($quest->id === $questId) {
                $this->availableQuests->removeElement($quest);
                $this->currentQuest = $quest->start();

                return;
            }
        }

        throw new AvailableQuestNotFoundException();
    }

    public function finishQuest(): void
    {
        $this->questHistory[] = $this->currentQuest;
        $this->currentQuest = null;
    }

    public function progress(string $questActionId): void
    {
        $this->currentQuest->progress($questActionId, $this->gameStatus);
    }

    /**
     * @param Collection<int, Quest> $possibleQuests
     */
    public function updatePossibleQuests(Collection $possibleQuests): void
    {
        $this->availableQuests = $possibleQuests->filter(fn($quest) => $quest->isAvailable($this->gameStatus));
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

    public function __isset(string $name)
    {
        return in_array($name, ['currentQuest', 'questHistory', 'availableQuests', 'gameStatus']);
    }
}
