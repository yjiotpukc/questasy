<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping\QuestAction;

use Game\Domain\Entity\Condition\Condition;
use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class AbstractQuestAction extends EmbeddedDocumentMapping
{
    public function map(EmbeddedDocument $builder): void
    {
        $builder->string('id');
        $builder->string('text');
        $builder->embedOne('visibilityCondition', Condition::class)->nullable();
        $builder->embedOne('availabilityCondition', Condition::class)->nullable();
    }
}
