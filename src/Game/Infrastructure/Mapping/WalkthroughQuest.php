<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping;

use Game\Domain\Entity\QuestAction\Branching;
use Game\Domain\Entity\QuestAction\Determined;
use Game\Domain\Entity\QuestAction\Random;
use Game\Domain\Entity\QuestStage\QuestStage;
use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class WalkthroughQuest extends EmbeddedDocumentMapping
{
    public function map(EmbeddedDocument $builder): void
    {
        $builder->string('title');
        $builder->string('description');
        $builder->embedMany('stages', QuestStage::class);
        $builder->embedMany('actions')
            ->discriminator('type')
            ->map('determined', Determined::class)
            ->map('random', Random::class)
            ->map('branching', Branching::class);
        $builder->string('currentStageId');
        $builder->embedMany('stageHistory', QuestStage::class);
    }
}
