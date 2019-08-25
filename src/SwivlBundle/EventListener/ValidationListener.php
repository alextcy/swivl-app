<?php

namespace SwivlBundle\EventListener;

use SwivlBundle\ResourceRepresentation\QueryRepresentationInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use SwivlBundle\ResourceRepresentation\ResourceRepresentationInterface;

//use Tonic\Bundle\RestBundle\ResourceRepresentation\QueryRepresentationInterface;
//use Tonic\Bundle\RestBundle\ResourceRepresentation\ResourceRepresentationInterface;
//use Tonic\Bundle\RestBundle\Validation\Exception\ValidationFailedException;
//use Tonic\Bundle\RestBundle\Validation\ValidationFailedExceptionFactoryInterface;

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
        /** @var ResourceRepresentationInterface $resourceRepresentation */
        $resourceRepresentation = null;
        foreach ($event->getRequest()->attributes->all() as $possibleControllerArgument) {
            if (
                is_object($possibleControllerArgument) &&
                ($possibleControllerArgument instanceof ResourceRepresentationInterface
                ||
                $possibleControllerArgument instanceof QueryRepresentationInterface)) {
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