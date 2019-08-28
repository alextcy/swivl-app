<?php

namespace SwivlBundle\EventListener\Common;

use JMS\Serializer\SerializerInterface;
use SwivlBundle\Presentation\ErrorPresentation\ErrorPresentationFactoryInterface;
use SwivlBundle\Presentation\ErrorPresentation\Exception\UnsupportedExceptionTypeException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;


/**
 * Class ExceptionListener
 */
class ExceptionListener
{
    /**
     * @var ErrorPresentationFactoryInterface
     */
    private $errorPresentationFactory;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param ErrorPresentationFactoryInterface $errorPresentationFactory
     * @param SerializerInterface $serializer
     */
    public function __construct(ErrorPresentationFactoryInterface $errorPresentationFactory, SerializerInterface $serializer)
    {
        $this->errorPresentationFactory = $errorPresentationFactory;
        $this->serializer = $serializer;
    }

    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $request = $event->getRequest();

        try {
            $exception = $event->getException();
            $presentation = $this->errorPresentationFactory->create($exception);

            $acceptableContentTypes = $request->getAcceptableContentTypes();
            foreach ($acceptableContentTypes as $acceptableContentType) {
                $acceptableFormat = $request->getFormat($acceptableContentType);

                $serialized = $this->serializer->serialize($presentation->getData(), $acceptableFormat);

                $response = $presentation->getResponse();
                $response->setContent($serialized);
                $response->headers->set('Content-Type', $acceptableContentType);

                $event->setResponse($response);

                return;
            }
        } catch (UnsupportedExceptionTypeException $e) {
            return;
        }
    }
}