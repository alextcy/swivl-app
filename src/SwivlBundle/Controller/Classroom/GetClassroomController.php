<?php

namespace SwivlBundle\Controller\Classroom;

use SwivlBundle\Controller\ApplicationResponse;
use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Presentation\Response\ClassroomPresentation;
use SwivlBundle\Service\Classroom\Model\Classroom;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(service="swivl.controller.get_classroom")
 */
class GetClassroomController extends Controller
{
    /**
     * @Route(
     *     "/classrooms/{id}",
     *     requirements={"id": "\d+"},
     *     name="get_classroom",
     *     methods={"GET"}
     * )
     *
     * @param Classroom $classroom
     *
     * @return ApplicationResponseInterface
     */
    public function getClassroom(Classroom $classroom): ApplicationResponseInterface
    {
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