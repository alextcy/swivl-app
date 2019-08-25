<?php


namespace SwivlBundle\Service\CommandBus\CommandResult;

/**
 * Class CommandResult
 */
class CommandResult implements CommandResultInterface
{
    /**
     * @var bool
     */
    private $success;
    /**
     * @var array
     */
    private $context;

    /**
     * @param bool   $success
     * @param array  $context
     */
    public function __construct(bool $success = true, array $context = [])
    {
        $this->success = $success;
        $this->context = $context;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }
}