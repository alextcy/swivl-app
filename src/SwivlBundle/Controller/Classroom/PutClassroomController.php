<?php

namespace SwivlBundle\Controller\Classroom;

use League\Tactician\CommandBus;
use SwivlBundle\Controller\ApplicationResponse;
use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Presentation\Request\PutClassroomPresentation;
use SwivlBundle\Presentation\Response\Factory\ClassroomPresentationFactory;
use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\CommandBus\Command\UpdateClassroomCommand;
use SwivlBundle\Service\CommandBus\Command\UpdateClassroomCommandResult;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(service="swivl.controller.put_classroom")
 */
class PutClassroomController extends Controller
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var ClassroomPresentationFactory
     */
    private $factory;

    /**
     * @param CommandBus $commandBus
     * @param ClassroomPresentationFactory $factory
     */
    public function __construct(CommandBus $commandBus, ClassroomPresentationFactory $factory)
    {
        $this->commandBus = $commandBus;
        $this->factory = $factory;
    }

    /**
     * @Route(
     *     "/classrooms/{id}",
     *     requirements={"id": "\d+"},
     *     name="put_classroom",
     *     methods={"PUT"}
     * )
     *
     * @param Classroom $classroom
     * @param PutClassroomPresentation $putClassroom
     *
     * @return ApplicationResponseInterface
     */
    public function updateClassroom(Classroom $classroom, PutClassroomPresentation $putClassroom)
    {
        /** @var UpdateClassroomCommandResult $result */
        $result = $this->commandBus->handle(new UpdateClassroomCommand(
            $classroom->getId(),
            $putClassroom->name,
            $putClassroom->enable
        ));

        $presentation = $this->factory->create($classroom);

        return new ApplicationResponse($presentation, Response::HTTP_OK);
    }
}
