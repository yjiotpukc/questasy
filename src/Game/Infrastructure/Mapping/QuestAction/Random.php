<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping\QuestAction;

use Game\Domain\Entity\QuestStage\PossibleQuestStage;
use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;

class Random extends AbstractQuestAction
{
    public function map(EmbeddedDocument $builder): void
    {
        parent::map($builder);
        $builder->embedMany('possibleStages', PossibleQuestStage::class);
    }
}
