<?php

namespace SwivlBundle\EventListener\Common;

use JMS\Serializer\Exception\UnsupportedFormatException;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use SwivlBundle\Controller\ApplicationResponse;
use SwivlBundle\Controller\ApplicationResponseInterface;
use SwivlBundle\Presentation\ResponsePresentationInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

/**
 * Class ControllerResponseListener
 */
class ControllerResponseListener
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var bool
     */
    private $serializeNull;

    /**
     * @param SerializerInterface $serializer
     * @param bool|false          $serializeNull
     */
    public function __construct(SerializerInterface $serializer, $serializeNull = false)
    {
        $this->serializer = $serializer;
        $this->serializeNull = $serializeNull;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $applicationResponse = $event->getControllerResult();
        if (!($applicationResponse instanceof ApplicationResponseInterface)) {
            return;
        }

        $request = $event->getRequest();
        $acceptableContentTypes = $request->getAcceptableContentTypes();

        foreach ($acceptableContentTypes as $acceptableContentType) {
            try {

                $context = new SerializationContext();
                if ($this->serializeNull) {
                    $context->setSerializeNull($this->serializeNull);
                }

                $presentationData = $this->getPresentationData($applicationResponse);

                $acceptableFormat = $request->getFormat($acceptableContentType);
                $serialized = $this->serializer->serialize($presentationData, $acceptableFormat, $context);

                $response = $applicationResponse->getResponse();
                $response->setContent($serialized);
                $response->headers->set('Content-Type', $acceptableContentType);

                $event->setResponse($response);

                return;
            } catch (UnsupportedFormatException $e) {
                continue;
            }
        }
    }

    /**
     * @param ApplicationResponse $applicationResponse
     * @return string|ResponsePresentationInterface
     */
    private function getPresentationData(ApplicationResponse $applicationResponse)
    {
        $presentationData = $applicationResponse->getData();

        //if response NO CONTENT or just empty response body (to prevent NotAcceptableException)
        if ($applicationResponse->getData() === null && !$this->serializeNull) {
            $presentationData = '';
        }

        return $presentationData;
    }
}