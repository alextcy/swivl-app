<?php

namespace SwivlBundle\Controller;

use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Presentation\ResponsePresentationInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApplicationResponse
 */
class ApplicationResponse implements ApplicationResponseInterface
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @return ApplicationResponse
     */
    public static function noContent()
    {
        return new static(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param ResponsePresentationInterface|null $data
     *
     * @return ApplicationResponse
     */
    public static function ok(ResponsePresentationInterface $data = null)
    {
        return new static($data, Response::HTTP_OK);
    }

    /**
     * @param ResponsePresentationInterface|null $data
     * @param int|null   $statusCode
     * @param array      $headers
     */
    public function __construct(
        ResponsePresentationInterface $data = null,
        $statusCode = null,
        array $headers = []
    ) {
        $this->data = $data;

        $this->response = new Response();
        $this->response->setStatusCode($statusCode ?: Response::HTTP_OK);
        $this->response->headers->replace($headers);
    }

    /**
     * @return ResponsePresentationInterface
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}