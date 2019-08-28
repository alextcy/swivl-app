<?php

namespace SwivlBundle\Presentation\ErrorPresentation;

use SwivlBundle\Controller\ApplicationResponse;
use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Presentation\ResponsePresentationInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ErrorPresentation
 */
class ErrorPresentation implements ApplicationResponseInterface
{
    /**
     * @var ApplicationResponse
     */
    private $presentation;

    /**
     * @param string $message
     * @param int    $statusCode
     *
     * @return ErrorPresentation
     */
    public static function create($message, $statusCode)
    {
        return new static(new CommonErrorPresentation($message), $statusCode);
    }

    /**
     * @param string $message
     *
     * @return ErrorPresentation
     */
    public static function notFound($message = '')
    {
        return static::create($message, Response::HTTP_NOT_FOUND);
    }

    /**
     * @param string $message
     *
     * @return ErrorPresentation
     */
    public static function badRequest($message = '')
    {
        return static::create($message, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param string $message
     *
     * @return ErrorPresentation
     */
    public static function conflict($message = '')
    {
        return static::create($message, Response::HTTP_CONFLICT);
    }

    /**
     * @param CommonErrorPresentation $errorRepresentation
     * @param int $statusCode
     * @param array $headers
     */
    public function __construct(CommonErrorPresentation $errorRepresentation, $statusCode, array $headers = [])
    {
        $this->presentation = new ApplicationResponse($errorRepresentation, $statusCode, $headers);
    }

    /**
     * @return ResponsePresentationInterface
     */
    public function getData(): ResponsePresentationInterface
    {
        return $this->presentation->getData();
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->presentation->getResponse();
    }
}