<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestAction;

use Doctrine\Common\Collections\Collection;
use Exception;
use Game\Domain\Entity\GameStatus;
use Game\Domain\Entity\QuestStage\PossibleQuestStage;
use LogicException;

class Random extends AbstractQuestAction
{
    /** @var Collection<int, PossibleQuestStage> */
    protected Collection $possibleStages;

    public function nextStage(GameStatus $gameStatus): string
    {
        foreach ($this->possibleStages as $possibleStage) {
            $possibleStage->countPossibility($gameStatus);
        }

        $random = $this->getRandomInt($this->sumPossibilities());

        return $this->findStageWithPossibility($random);
    }

    private function getRandomInt(int $max): int
    {
        try {
            return random_int(1, $max);
        } catch (Exception $exception) {
            throw new LogicException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    private function sumPossibilities(): int
    {
        return array_sum($this->possibleStages->map(
            static fn(PossibleQuestStage $stage) => $stage->countedPossibility
        )->toArray());
    }

    private function findStageWithPossibility(int $possibility): string
    {
        foreach ($this->possibleStages as $possibleStage) {
            if ($possibility <= $possibleStage->countedPossibility) {
                return $possibleStage->questStageId;
            }

            $possibility -= $possibleStage->countedPossibility;
        }

        throw new LogicException('Wrong logic in choosing quest stage');
    }
}
