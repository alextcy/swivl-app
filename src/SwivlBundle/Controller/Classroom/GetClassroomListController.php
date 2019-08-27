<?php

namespace SwivlBundle\Controller\Classroom;

use SwivlBundle\Controller\ApplicationResponse;
use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Presentation\Query\ClassroomFilterQueryPresentation;
use SwivlBundle\Presentation\Response\ClassroomPaginatedListPresentation;
use SwivlBundle\Presentation\Response\ClassroomPresentation;
use SwivlBundle\Presentation\Response\Factory\ClassroomPaginatedListPresentationFactory;
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
     * @var ClassroomPaginatedListPresentationFactory
     */
    private $factory;

    /**
     * @param ClassroomRepository $repository
     * @param ClassroomPaginatedListPresentationFactory $factory
     */
    public function __construct(ClassroomRepository $repository, ClassroomPaginatedListPresentationFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
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

        $presentation = $this->factory->create($paginatedCollection);

        return new ApplicationResponse($presentation, Response::HTTP_OK);
    }
}
