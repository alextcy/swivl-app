<?php

namespace SwivlBundle\Presentation\Response\Factory;

use SwivlBundle\Presentation\Response\ClassroomPresentation;
use SwivlBundle\Service\Classroom\Model\Classroom;

/**
 * Class ClassroomPresentationFactory
 */
class ClassroomPresentationFactory
{
    /**
     * @param Classroom $classroom
     *
     * @return ClassroomPresentation
     */
    public function create(Classroom $classroom): ClassroomPresentation
    {
        $presentation = new ClassroomPresentation();
        $presentation->id = $classroom->getId();
        $presentation->name = $classroom->getName();
        $presentation->enabled = $classroom->isEnabled();
        $presentation->updatedAt = $classroom->getUpdatedAt();

        return $presentation;
    }
}