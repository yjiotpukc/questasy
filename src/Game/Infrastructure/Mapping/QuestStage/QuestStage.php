<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping\QuestStage;

use Game\Domain\Entity\QuestEffect\QuestEffectGiveMoney;
use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class QuestStage extends EmbeddedDocumentMapping
{
    public function map(EmbeddedDocument $builder): void
    {
        $builder->string('id');
        $builder->string('text');
        $builder->embedMany('effects')
            ->discriminator('type')
            ->map('giveMoney', QuestEffectGiveMoney::class);
        $builder->array('actions');
    }
}
