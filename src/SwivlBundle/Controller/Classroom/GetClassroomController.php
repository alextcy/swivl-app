<?php

namespace SwivlBundle\Controller\Classroom;

use SwivlBundle\Controller\ApplicationResponse;
use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Presentation\Response\ClassroomPresentation;
use SwivlBundle\Presentation\Response\Factory\ClassroomPresentationFactory;
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
     * @var ClassroomPresentationFactory
     */
    private $factory;

    /**
     * @param ClassroomPresentationFactory $factory
     */
    public function __construct(ClassroomPresentationFactory $factory)
    {
        $this->factory = $factory;
    }

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
        $presentation = $this->factory->create($classroom);

        return new ApplicationResponse($presentation, Response::HTTP_OK);
    }
}
