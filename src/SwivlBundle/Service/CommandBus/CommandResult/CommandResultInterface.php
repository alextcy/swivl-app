<?php

namespace SwivlBundle\Service\CommandBus\CommandResult;

/**
 * Class CommandResultInterface
 */
interface CommandResultInterface
{
    /**
     * @return bool
     */
    public function isSuccess(): bool;

    /**
     * @return array
     */
    public function getContext(): array;
}