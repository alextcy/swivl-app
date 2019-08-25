<?php


namespace SwivlBundle\Presentation\Response;

use SwivlBundle\Presentation\ResponsePresentationInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Class ClassroomPresentation
 */
class ClassroomPresentation implements ResponsePresentationInterface
{
    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    public $id;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    public $name;

    /**
     * @var bool
     */
    public $enabled;

    /**
     * @var \DateTime
     *
     * @JMS\Type("DateTime<'Y-m-d\TH:i:sP'>")
     */
    public $updatedAt;
}