<?php

namespace SwivlBundle\Service\CommandBus\Command;

use SwivlBundle\Service\CommandBus\CommandResult\CommandResultInterface;

/**
 * Class UpdateClassroomCommandResult
 */
class UpdateClassroomCommandResult implements CommandResultInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}