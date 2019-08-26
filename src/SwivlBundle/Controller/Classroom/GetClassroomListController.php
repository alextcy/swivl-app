<?php

namespace SwivlBundle\Controller\Classroom;

use SwivlBundle\Controller\ApplicationResponse;
use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Presentation\Query\ClassroomFilterQueryPresentation;
use SwivlBundle\Presentation\Response\ClassroomPaginatedListPresentation;
use SwivlBundle\Presentation\Response\ClassroomPresentation;
use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\Classroom\Model\Collection\ClassroomPaginatedCollection;
use SwivlBundle\Service\Classroom\Repository\ClassroomRepository;
use SwivlBundle\Service\Classroom\Repository\Filter\ClassroomSearchFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(service="swivl.controller.get_classroom_list")
 */
class GetClassroomListController extends Controller
{
    /**
     * @var ClassroomRepository
     */
    private $repository;

    /**
     * @param ClassroomRepository $repository
     */
    public function __construct(ClassroomRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/classrooms", name="get_classrooms", methods={"GET"})
     *
     * return ApplicationResponseInterface
     */
    public function getClassrooms(ClassroomFilterQueryPresentation $queryPresentation): ApplicationResponseInterface
    {
        $filter = new ClassroomSearchFilter();
        $filter->setLimit($queryPresentation->limit)
            ->setOffset($queryPresentation->offset);

        $paginatedCollection = $this->repository->search($filter);

        $presentation = $this->getClassroomListPresentation($paginatedCollection);

        return new ApplicationResponse($presentation, Response::HTTP_OK);
    }

    /**
     * @param ClassroomPaginatedCollection $paginatedCollection
     *
     * @return ClassroomPaginatedListPresentation
     */
    private function getClassroomListPresentation(ClassroomPaginatedCollection $paginatedCollection): ClassroomPaginatedListPresentation
    {
        $presentation = new ClassroomPaginatedListPresentation();
        $presentation->total = $paginatedCollection->getTotalItems();
        $presentation->offset = $paginatedCollection->getOffset();
        $presentation->limit = $paginatedCollection->getLimit();

        /** @var Classroom $classroom */
        foreach ($paginatedCollection as $classroom) {
            $presentation->classrooms[] = $this->getClassroomPresentation($classroom);
        }

        return $presentation;
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