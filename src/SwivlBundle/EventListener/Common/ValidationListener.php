<?php

namespace SwivlBundle\EventListener\Common;

use SwivlBundle\EventListener\ValidationFailedException;
use SwivlBundle\EventListener\ValidationFailedExceptionFactoryInterface;
use SwivlBundle\Presentation\QueryPresentationInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use SwivlBundle\Presentation\RequestBodyPresentationInterface;

/**
 * Class ValidationListener
 */
class ValidationListener
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var ValidationFailedExceptionFactoryInterface
     */
    private $validationFailedExceptionFactory;

    /**
     * @param ValidatorInterface                        $validator
     * @param ValidationFailedExceptionFactoryInterface $validationFailedExceptionFactory
     */
    public function __construct(
        ValidatorInterface $validator
        //ValidationFailedExceptionFactoryInterface $validationFailedExceptionFactory
    ) {
        $this->validator = $validator;
        //$this->validationFailedExceptionFactory = $validationFailedExceptionFactory;
    }

    /**
     * @param FilterControllerEvent $event
     *
     * @throws ValidationFailedException
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        /** @var RequestBodyPresentationInterface $resourceRepresentation */
        $resourceRepresentation = null;
        foreach ($event->getRequest()->attributes->all() as $possibleControllerArgument) {
            if (
                is_object($possibleControllerArgument) &&
                ($possibleControllerArgument instanceof RequestBodyPresentationInterface
                ||
                $possibleControllerArgument instanceof QueryPresentationInterface)) {
                $resourceRepresentation = $possibleControllerArgument;
                continue;
            }
        }

        if (null == $resourceRepresentation) {
            return;
        }

        $violationList = $this->validator->validate($resourceRepresentation);
        if (count($violationList) == 0) {
            return;
        }

        //throw $this->validationFailedExceptionFactory->create('Validation failed', 0, null, $violationList);
    }
}