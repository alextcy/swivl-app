<?php

namespace SwivlBundle\Presentation\Request;

use SwivlBundle\Presentation\RequestBodyPresentationInterface;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

/**
 * Class PutClassroomResourceRepresentation
 */
class PutClassroomPresentation implements RequestBodyPresentationInterface
{
    /**
     * @JMS\Type("string")
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     *
     * @var string
     */
    public $name;

    /**
     * @JMS\Type("bool")
     * @Assert\Type("bool")
     * @Assert\NotNull()
     *
     * @var bool
     */
    public $enable;
}