<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping;

use Game\Domain\Entity\Condition\Condition;
use Game\Domain\Entity\QuestAction\Branching;
use Game\Domain\Entity\QuestAction\Determined;
use Game\Domain\Entity\QuestAction\Random;
use Game\Domain\Entity\QuestStage\QuestStage;
use yjiotpukc\MongoODMFluent\Builder\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Quest extends DocumentMapping
{
    public function map(Document $builder): void
    {
        $builder->collection('quests');
        $builder->id();
        $builder->string('title');
        $builder->string('description');
        $builder->embedOne('startingStage', QuestStage::class);
        $builder->embedMany('stages', QuestStage::class);
        $builder->embedMany('actions')
            ->discriminator('type')
            ->map('determined', Determined::class)
            ->map('random', Random::class)
            ->map('branching', Branching::class);
        $builder->embedMany('conditions', Condition::class);
    }
}
