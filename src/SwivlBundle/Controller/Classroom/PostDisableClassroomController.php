<?php

namespace SwivlBundle\Controller\Classroom;

use League\Tactician\CommandBus;
use SwivlBundle\Controller\ApplicationResponse;
use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Presentation\Response\ClassroomPresentation;
use SwivlBundle\Presentation\Response\Factory\ClassroomPresentationFactory;
use SwivlBundle\Service\CommandBus\Command\DisableClassroomCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SwivlBundle\Service\Classroom\Model\Classroom;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(service="swivl.controller.post_disable_classroom")
 */
class PostDisableClassroomController extends Controller
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
     *     "/classrooms/{id}/disable",
     *     requirements={"id": "\d+"},
     *     name="post_disable_classroom",
     *     methods={"POST"}
     * )
     *
     * @param Classroom $classroom
     *
     * @return ApplicationResponseInterface
     */
    public function disableClassroom(Classroom $classroom): ApplicationResponseInterface
    {
        $this->commandBus->handle(new DisableClassroomCommand(
            $classroom->getId()
        ));

        $presentation = $this->factory->create($classroom);

        return new ApplicationResponse($presentation, Response::HTTP_OK);
    }
}
