<?php

namespace SwivlBundle\Service\CommandBus\Command;

use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\Classroom\Repository\ClassroomRepository;
use SwivlBundle\Service\CommandBus\Command\Exception\ClassroomNotFoundException;
use SwivlBundle\Service\CommandBus\CommandResult\CommandResultInterface;

/**
 * Class DeleteClassroomCommandHandler
 */
class DeleteClassroomCommandHandler
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
     * @param DeleteClassroomCommand $command
     * @throws ClassroomNotFoundException
     */
    public function handle(DeleteClassroomCommand $command): void
    {
        $classroom = $this->classroomRepository->findOneBy(['id' => $command->getId()]);

        if(!$classroom instanceof Classroom) {
            throw new ClassroomNotFoundException($command->getId());
        }

        $this->classroomRepository->remove($classroom);
    }
}