<?php

namespace SwivlBundle\EventListener\Common;

use SwivlBundle\Service\Validation\ValidationFailedException;
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
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
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

        throw new ValidationFailedException('Validation failed', 0, null, $violationList);
    }
}