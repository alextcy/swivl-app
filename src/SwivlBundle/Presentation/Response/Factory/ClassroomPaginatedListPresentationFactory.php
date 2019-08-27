<?php

namespace SwivlBundle\Presentation\Response\Factory;

use SwivlBundle\Presentation\Response\ClassroomPaginatedListPresentation;
use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\Classroom\Model\Collection\ClassroomPaginatedCollection;

/**
 * Class ClassroomPaginatedListPresentationFactory
 */
class ClassroomPaginatedListPresentationFactory
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
     * @param ClassroomPaginatedCollection $paginatedCollection
     *
     * @return ClassroomPaginatedListPresentation
     */
    public function create(ClassroomPaginatedCollection $paginatedCollection): ClassroomPaginatedListPresentation
    {
        $presentation = new ClassroomPaginatedListPresentation();
        $presentation->total = $paginatedCollection->getTotalItems();
        $presentation->offset = $paginatedCollection->getOffset();
        $presentation->limit = $paginatedCollection->getLimit();

        /** @var Classroom $classroom */
        foreach ($paginatedCollection as $classroom) {
            $presentation->classrooms[] = $this->factory->create($classroom);
        }

        return $presentation;
    }
}