<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping\QuestAction;

use Game\Domain\Entity\QuestStage\QuestStageWithCondition;
use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;

class Branching extends AbstractQuestAction
{
    public function map(EmbeddedDocument $builder): void
    {
        parent::map($builder);
        $builder->embedMany('stagesWithCondition', QuestStageWithCondition::class);
    }
}
