<?php

namespace SwivlBundle\Controller\Classroom;

use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Presentation\Request\PostClassroomPresentation;
use SwivlBundle\Presentation\Response\ClassroomPresentation;
use SwivlBundle\Presentation\Response\Factory\ClassroomPresentationFactory;
use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\Classroom\Repository\ClassroomRepository;
use SwivlBundle\Service\CommandBus\Command\CreateClassroomCommand;
use SwivlBundle\Service\CommandBus\Command\CreateClassroomCommandResult;
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
     * @var ClassroomPresentationFactory
     */
    private $factory;

    /**
     * @param CommandBus $commandBus
     * @param ClassroomRepository $repository
     * @param ClassroomPresentationFactory $factory
     */
    public function __construct(CommandBus $commandBus, ClassroomRepository $repository, ClassroomPresentationFactory $factory)
    {
        $this->commandBus = $commandBus;
        $this->repository = $repository;
        $this->factory = $factory;
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

        $presentation = $this->factory->create($classroom);

        return new ApplicationResponse($presentation, Response::HTTP_CREATED);
    }
}
