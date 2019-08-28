<?php

namespace SwivlBundle\Service\CommandBus\Command;

use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\Classroom\Repository\ClassroomRepository;
use SwivlBundle\Service\CommandBus\Command\Exception\ClassroomNotFoundException;
use SwivlBundle\Service\CommandBus\CommandResult\CommandResultInterface;

/**
 * Class EnableClassroomCommandHandler
 */
class EnableClassroomCommandHandler
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
     * @param EnableClassroomCommand $command
     *
     * @return CommandResultInterface
     * @throws ClassroomNotFoundException
     */
    public function handle(EnableClassroomCommand $command): CommandResultInterface
    {
        $classroom = $this->classroomRepository->findOneBy(['id' => $command->getId()]);

        if(!$classroom instanceof Classroom) {
            throw new ClassroomNotFoundException($command->getId());
        }

        if (!$classroom->isEnabled()) {
            $classroom->setEnabled(true);
            $this->classroomRepository->save($classroom);
        }

        return new EnableClassroomCommandResult();
    }
}