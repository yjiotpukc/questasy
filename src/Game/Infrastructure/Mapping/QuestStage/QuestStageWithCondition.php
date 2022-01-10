<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping\QuestStage;

use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class QuestStageWithCondition extends EmbeddedDocumentMapping
{
    public function map(EmbeddedDocument $builder): void
    {
        $builder->string('questStageId');
        $builder->embedOne('condition')->discriminator('type');
    }
}
