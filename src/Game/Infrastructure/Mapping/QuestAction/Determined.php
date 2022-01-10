<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping\QuestAction;

use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;

class Determined extends AbstractQuestAction
{
    public function map(EmbeddedDocument $builder): void
    {
        parent::map($builder);
        $builder->int('questStageId');
    }
}
