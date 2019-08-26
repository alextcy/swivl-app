<?php

namespace SwivlBundle\Presentation\Response;

use SwivlBundle\Presentation\ResponsePresentationInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Class ClassroomPaginatedListPresentation
 */
class ClassroomPaginatedListPresentation implements ResponsePresentationInterface
{
    /**
     * @JMS\Type("array<SwivlBundle\Presentation\Response\ClassroomPresentation>")
     */
    public $classrooms;

    /**
     * @JMS\Type("integer")
     *
     * @var int
     */
    public $total;

    /**
     * @JMS\Type("integer")
     *
     * @var int
     */
    public $offset;

    /**
     * @JMS\Type("integer")
     *
     * @var int
     */
    public $limit;
}