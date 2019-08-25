<?php

namespace SwivlBundle\Controller\Classroom;

use League\Tactician\CommandBus;
use SwivlBundle\Controller\ApplicationResponse;
use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Presentation\Request\PutClassroomPresentation;
use SwivlBundle\Presentation\Response\ClassroomPresentation;
use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\Classroom\Repository\ClassroomRepository;
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

        $classroom = $this->repository->findOneBy(['id' => $result->getId()]);

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
