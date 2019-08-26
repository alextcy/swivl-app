<?php

namespace SwivlBundle\Controller\Classroom;

use League\Tactician\CommandBus;
use SwivlBundle\Controller\ApplicationResponse;
use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\CommandBus\Command\DeleteClassroomCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route(service="swivl.controller.delete_classroom")
 */
class DeleteClassroomController extends Controller
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
     *     "/classrooms/{id}",
     *     requirements={"id": "\d+"},
     *     name="delete_classroom",
     *     methods={"DELETE"}
     * )
     *
     * @param Classroom $classroom
     *
     * @return ApplicationResponseInterface
     */
    public function deleteClassroom(Classroom $classroom): ApplicationResponseInterface
    {
        $this->commandBus->handle(new DeleteClassroomCommand(
            $classroom->getId()
        ));

        return ApplicationResponse::noContent();
    }
}