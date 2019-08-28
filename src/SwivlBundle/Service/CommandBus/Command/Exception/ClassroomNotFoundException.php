<?php

namespace SwivlBundle\Service\CommandBus\Command\Exception;

use phpDocumentor\Reflection\Types\Parent_;
use SwivlBundle\Service\Common\Exception\AbstractModelNotFoundException;

/**
 * Class ClassroomNotFoundException
 */
class ClassroomNotFoundException extends AbstractModelNotFoundException
{
    /**
     * @param int $classroomId
     */
    public function __construct(int $classroomId)
    {
        parent::__construct(
            sprintf('Classroom with id [%s] was not found', $classroomId)
        );
    }
}