<?php

namespace SwivlBundle\Controller\Classroom;

use League\Tactician\CommandBus;
use SwivlBundle\Controller\ApplicationResponse;
use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Presentation\Response\Factory\ClassroomPresentationFactory;
use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\CommandBus\Command\EnableClassroomCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route(service="swivl.controller.post_enable_classroom")
 */
class PostEnableClassroomController extends Controller
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
     *     "/classrooms/{id}/enable",
     *     requirements={"id": "\d+"},
     *     name="post_enable_classroom",
     *     methods={"POST"}
     * )
     *
     * @param Classroom $classroom
     *
     * @return ApplicationResponseInterface
     */
    public function disableClassroom(Classroom $classroom): ApplicationResponseInterface
    {
        $this->commandBus->handle(new EnableClassroomCommand(
            $classroom->getId()
        ));

        $presentation = $this->factory->create($classroom);

        return new ApplicationResponse($presentation, Response::HTTP_OK);
    }
}
