<?php

namespace SwivlBundle\Service\CommandBus\Command;

/**
 * Class UpdateClassroomCommand
 */
class UpdateClassroomCommand
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $enable;

    /**
     * @param int    $id
     * @param string $name
     * @param bool   $enable
     */
    public function __construct(int $id, string $name, bool $enable)
    {
        $this->id = $id;
        $this->name = $name;
        $this->enable = $enable;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isEnable(): bool
    {
        return $this->enable;
    }
}