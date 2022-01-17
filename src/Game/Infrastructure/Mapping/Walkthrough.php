<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping;

use Game\Domain\Entity\GameStatus;
use Game\Domain\Entity\Quest;
use Game\Domain\Entity\WalkthroughQuest;
use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class Walkthrough extends EmbeddedDocumentMapping
{
    public function map(EmbeddedDocument $builder): void
    {
        $builder->id();
        $builder->embedOne('currentQuest', WalkthroughQuest::class);
        $builder->embedMany('questHistory', WalkthroughQuest::class);
        $builder->referenceMany('availableQuests', Quest::class);
        $builder->embedOne('gameStatus', GameStatus::class);
    }
}
