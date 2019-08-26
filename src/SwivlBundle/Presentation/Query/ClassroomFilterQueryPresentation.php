<?php

namespace SwivlBundle\Presentation\Query;

use SwivlBundle\Presentation\QueryPresentationInterface;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

class ClassroomFilterQueryPresentation implements QueryPresentationInterface
{
    /**
     * @var int
     *
     * @JMS\Type("integer")
     *
     * @Assert\Type("numeric")
     * @Assert\GreaterThanOrEqual(0)
     */
    public $offset = 0;

    /**
     * @var int
     *
     * @JMS\Type("integer")
     *
     * @Assert\Type("numeric")
     * @Assert\Range(min = 0, max = 100)
     */
    public $limit = 10;
}