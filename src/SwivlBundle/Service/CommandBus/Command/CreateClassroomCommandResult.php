<?php

namespace SwivlBundle\Service\CommandBus\Command;

use SwivlBundle\Service\CommandBus\CommandResult\CommandResultInterface;

/**
 * Class CreateClassroomCommandResult
 */
class CreateClassroomCommandResult implements CommandResultInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @param int $classroomId
     */
    public function __construct(int $classroomId)
    {
        $this->id = $classroomId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}