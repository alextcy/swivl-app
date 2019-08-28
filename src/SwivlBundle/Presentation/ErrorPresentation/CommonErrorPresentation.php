<?php

namespace SwivlBundle\Presentation\ErrorPresentation;

use JMS\Serializer\Annotation as JMS;
use SwivlBundle\Presentation\ResponsePresentationInterface;

/**
 * Class CommonErrorPresentation
 */
class CommonErrorPresentation implements ResponsePresentationInterface
{
    /**
     * @JMS\Type("string")
     *
     * @var string
     */
    private $message;

    /**
     * @JMS\Type("array")
     *
     * @var array
     */
    private $errors;

    /**
     * @JMS\Type("string")
     *
     * @var string|null
     */
    private $path;

    /**
     * @param string $message
     * @param string|null $path
     * @param array $errors
     */
    public function __construct(string $message, string $path = null, array $errors = [])
    {
        $this->message = $message;
        $this->path = $path;
        $this->errors = $errors;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return CommonErrorPresentation[]|array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}