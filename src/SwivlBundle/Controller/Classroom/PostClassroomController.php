<?php

namespace SwivlBundle\Controller\Classroom;

use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Presentation\Request\PostClassroomPresentation;
use SwivlBundle\Presentation\Response\ClassroomPresentation;
use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\Classroom\Repository\ClassroomRepository;
use SwivlBundle\Service\CommandBus\Command\CreateClassroomCommand;
use SwivlBundle\Service\CommandBus\Command\CreateClassroomCommandResult;
use SwivlBundle\Service\CommandBus\CommandResult\CommandResult;
use SwivlBundle\Controller\ApplicationResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(service="swivl.controller.post_classroom")
 */
class PostClassroomController extends Controller
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var ClassroomRepository
     */
    private $repository;

    /**
     * @param CommandBus $commandBus
     * @param ClassroomRepository $repository
     */
    public function __construct(CommandBus $commandBus, ClassroomRepository $repository)
    {
        $this->commandBus = $commandBus;
        $this->repository = $repository;
    }


    /**
     * @Route("/classrooms", name="post_classroom", methods={"POST"})
     *
     * @param PostClassroomPresentation $postClassroom
     *
     * @return ApplicationResponseInterface
     */
    public function createClassroom(PostClassroomPresentation $postClassroom)
    {
        /** @var CreateClassroomCommandResult $result */
        $result = $this->commandBus->handle(new CreateClassroomCommand(
            $postClassroom->name,
            $postClassroom->enable
        ));

        $classroom = $this->repository->findOneBy(['id' => $result->getId()]);

        $presentation = $this->getClassroomPresentation($classroom);

        return new ApplicationResponse($presentation, Response::HTTP_CREATED);
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