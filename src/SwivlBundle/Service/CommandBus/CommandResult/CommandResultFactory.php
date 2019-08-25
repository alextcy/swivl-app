<?php

namespace SwivlBundle\Service\CommandBus\CommandResult;


class CommandResultFactory
{
    /**
     * @param bool   $success
     * @param array  $context
     *
     * @return CommandResultInterface
     */
    public function create(
        bool $success = true,
        array $context = []
    ): CommandResultInterface {
        return new CommandResult($success, $context);
    }
}