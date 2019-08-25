<?php

namespace SwivlBundle\Presentation\Request;

use SwivlBundle\Presentation\RequestBodyPresentationInterface;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

/**
 * Class PostClassroomResourceRepresentation
 */
class PostClassroomPresentation implements RequestBodyPresentationInterface
{
    /**
     * @JMS\Type("string")
     * @Assert\Type("string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    public $name;

    /**
     * @JMS\Type("bool")
     * @Assert\Type("bool")
     *
     * @var bool
     */
    public $enable;
}