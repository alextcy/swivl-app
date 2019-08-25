<?php

namespace SwivlBundle\EventListener\Common;

use JMS\Serializer\Exception\UnsupportedFormatException;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use SwivlBundle\Controller\ApplicationResponseInterface;
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
        $presentation = $event->getControllerResult();
        if (!($presentation instanceof ApplicationResponseInterface)) {
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

                $acceptableFormat = $request->getFormat($acceptableContentType);
                $serialized = $this->serializer->serialize($presentation->getData(), $acceptableFormat, $context);

                $response = $presentation->getResponse();
                $response->setContent($serialized);
                $response->headers->set('Content-Type', $acceptableContentType);

                $event->setResponse($response);

                return;
            } catch (UnsupportedFormatException $e) {
                continue;
            }
        }
    }
}