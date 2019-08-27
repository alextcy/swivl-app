<?php

namespace SwivlBundle\Service\CommandBus\Command;

use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\Classroom\Repository\ClassroomRepository;
use SwivlBundle\Service\CommandBus\CommandResult\CommandResultInterface;

/**
 * Class DisableClassroomCommandHandler
 */
class DisableClassroomCommandHandler
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
     * @param DisableClassroomCommand $command
     *
     * @return CommandResultInterface
     */
    public function handle(DisableClassroomCommand $command): CommandResultInterface
    {
        $classroom = $this->classroomRepository->findOneBy(['id' => $command->getId()]);

        if(!$classroom instanceof Classroom) {
            //throw exception
        }

        if ($classroom->isEnabled()) {
            $classroom->setEnabled(false);
            $this->classroomRepository->save($classroom);
        }

        return new DisableClassroomCommandResult();
    }
}
