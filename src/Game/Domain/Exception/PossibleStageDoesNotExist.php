<?php

declare(strict_types=1);

namespace Game\Domain\Exception;

use RuntimeException;

class PossibleStageDoesNotExist extends RuntimeException
{
    protected $message = 'Possible stage does not exist';
}
