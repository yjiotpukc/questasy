<?php

declare(strict_types=1);

namespace Game\Application;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Game\Domain\Entity\Player;
use Game\Domain\Entity\Quest;

class GameSeeder
{
    private DocumentManager $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function resetWalkthrough(): void
    {
        $quest = $this->documentManager->find(Quest::class, '61db3887df36e1609145afdb');
        $player = $this->documentManager->find(Player::class, '61db07efdf36e1609145afd4');
        $player->currentWalkthrough->updatePossibleQuests(new ArrayCollection([$quest]));
        $this->documentManager->persist($player);
        $this->documentManager->flush();
    }
}
