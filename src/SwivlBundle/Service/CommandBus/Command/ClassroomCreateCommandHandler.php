<?php


namespace SwivlBundle\Service\CommandBus\Command;

use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\Classroom\Repository\ClassroomRepository;
use SwivlBundle\Service\CommandBus\CommandResult\CommandResultFactory;
use SwivlBundle\Service\CommandBus\CommandResult\CommandResultInterface;

class ClassroomCreateCommandHandler
{
    /**
     * @var ClassroomRepository
     */
    private $classroomRepository;

    /**
     * @var CommandResultFactory
     */
    private $resultFactory;

    /**
     * @param ClassroomRepository $classroomRepository
     * @param CommandResultFactory $resultFactory
     */
    public function __construct(ClassroomRepository $classroomRepository, CommandResultFactory $resultFactory)
    {
        $this->classroomRepository = $classroomRepository;
        $this->resultFactory = $resultFactory;
    }

    /**
     * @param ClassroomCreateCommand $command
     *
     * @return CommandResultInterface
     */
    public function handle(ClassroomCreateCommand $command): CommandResultInterface
    {
        $classroom = new Classroom(
            $command->getName(),
            $command->isEnable()
        );

        $this->classroomRepository->save($classroom);

        return $this->successResult($classroom);
    }


    private function successResult(Classroom $classroom): CommandResultInterface
    {
        $context = [
            'id' => $classroom->getId(),
        ];

        return $this->resultFactory->create(true, $context);
    }
}