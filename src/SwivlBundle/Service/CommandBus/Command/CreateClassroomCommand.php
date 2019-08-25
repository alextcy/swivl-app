<?php


namespace SwivlBundle\Service\CommandBus\Command;

/**
 * Class CreateClassroomCommand
 */
class CreateClassroomCommand
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $enable;

    /**
     * @param string $name
     * @param bool $enable
     */
    public function __construct(string $name, bool $enable)
    {
        $this->name = $name;
        $this->enable = $enable;
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