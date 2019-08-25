<?php

namespace SwivlBundle\Service\CommandBus\Command;

use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\Classroom\Repository\ClassroomRepository;
use SwivlBundle\Service\CommandBus\CommandResult\CommandResultFactory;
use SwivlBundle\Service\CommandBus\CommandResult\CommandResultInterface;

/**
 * Class UpdateClassroomCommandHandler
 */
class UpdateClassroomCommandHandler
{
    /**
     * @var ClassroomRepository
     */
    private $classroomRepository;

    /**
     * @param ClassroomRepository $classroomRepository
     */
    public function __construct(ClassroomRepository $classroomRepository)
    {
        $this->classroomRepository = $classroomRepository;
    }

    /**
     * @param UpdateClassroomCommand $command
     *
     * @return CommandResultInterface
     */
    public function handle(UpdateClassroomCommand $command): CommandResultInterface
    {
        $classroom = $this->classroomRepository->findOneBy(['id' => $command->getId()]);

        $classroom->setName($command->getName());
        $classroom->setEnabled($command->isEnable());

        $this->classroomRepository->save($classroom);

        return new UpdateClassroomCommandResult($classroom->getId());
    }
}
