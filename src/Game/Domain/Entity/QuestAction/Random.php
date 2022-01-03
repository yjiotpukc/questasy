<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestAction;

use Exception;
use Game\Domain\Entity\GameStatus;
use Game\Domain\Entity\QuestStage\PossibleQuestStage;
use Game\Domain\Entity\QuestStage\QuestStage;
use LogicException;

class Random extends AbstractQuestAction
{
    /** @var PossibleQuestStage[] */
    protected array $possibleStages;

    public function nextStage(GameStatus $gameStatus): QuestStage
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
        return array_sum(array_map(
            static fn(PossibleQuestStage $stage) => $stage->countedPossibility,
            $this->possibleStages
        ));
    }

    private function findStageWithPossibility(int $possibility): QuestStage
    {
        foreach ($this->possibleStages as $possibleStage) {
            if ($possibility <= $possibleStage->countedPossibility) {
                return $possibleStage;
            }

            $possibility -= $possibleStage->countedPossibility;
        }

        throw new LogicException('Wrong logic in choosing quest stage');
    }
}
