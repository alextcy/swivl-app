<?php

namespace SwivlBundle\Controller\Classroom;

use League\Tactician\CommandBus;
use SwivlBundle\Controller\ApplicationResponse;
use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Presentation\Response\ClassroomPresentation;
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
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
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

        $presentation = $this->getClassroomPresentation($classroom);

        return new ApplicationResponse($presentation, Response::HTTP_OK);
    }

    /**
     * @param Classroom $classroom
     *
     * @return ClassroomPresentation
     */
    private function getClassroomPresentation(Classroom $classroom): ClassroomPresentation
    {
        $presentation = new ClassroomPresentation();
        $presentation->id = $classroom->getId();
        $presentation->name = $classroom->getName();
        $presentation->enabled = $classroom->isEnabled();
        $presentation->updatedAt = $classroom->getUpdatedAt();

        return $presentation;
    }
}
