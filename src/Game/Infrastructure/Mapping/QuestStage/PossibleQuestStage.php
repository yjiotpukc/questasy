<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping\QuestStage;

use Game\Domain\Entity\Possibility;
use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class PossibleQuestStage extends EmbeddedDocumentMapping
{
    public function map(EmbeddedDocument $builder): void
    {
        $builder->string('questStageId');
        $builder->embedOne('possibility')
            ->discriminator('type')
            ->map('simple', Possibility::class);
    }
}
