<?php

declare(strict_types=1);

namespace Common\Infra\Persistence\Cycle\Exception;

use Exception;

class RepositoryPersistException extends Exception implements CycleExceptionInterface {}
