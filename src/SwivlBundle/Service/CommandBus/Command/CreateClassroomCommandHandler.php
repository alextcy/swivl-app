<?php


namespace SwivlBundle\Service\CommandBus\Command;

use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\Classroom\Repository\ClassroomRepository;
use SwivlBundle\Service\CommandBus\CommandResult\CommandResultFactory;
use SwivlBundle\Service\CommandBus\CommandResult\CommandResultInterface;

/**
 * Class CreateClassroomCommandHandler
 */
class CreateClassroomCommandHandler
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
     * @param CreateClassroomCommand $command
     *
     * @return CommandResultInterface
     */
    public function handle(CreateClassroomCommand $command): CommandResultInterface
    {
        $classroom = new Classroom(
            $command->getName(),
            $command->isEnable()
        );

        $this->classroomRepository->save($classroom);


        return new CreateClassroomCommandResult($classroom->getId());
    }
}