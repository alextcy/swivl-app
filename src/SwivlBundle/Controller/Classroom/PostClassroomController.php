<?php

namespace SwivlBundle\Controller\Classroom;

use SwivlBundle\ResourceRepresentation\PostClassroomResourceRepresentation;
use SwivlBundle\Service\CommandBus\Command\ClassroomCreateCommand;
use SwivlBundle\Service\CommandBus\CommandResult\CommandResult;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @param CommandBus         $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Route("/classrooms", name="post_classroom", methods={"POST"})
     *
     * @param PostClassroomResourceRepresentation $postClassroom
     */
    public function createClassroom(PostClassroomResourceRepresentation $postClassroom)
    {
        /** @var CommandResult $result */
        $result = $this->commandBus->handle(new ClassroomCreateCommand(
            $postClassroom->name,
            $postClassroom->enable
        ));

        return new JsonResponse($result->getContext(), Response::HTTP_CREATED);
    }
}