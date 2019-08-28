<?php

namespace SwivlBundle\Service\Validation;

use SwivlBundle\Presentation\ErrorPresentation\CommonErrorPresentation;
use SwivlBundle\Presentation\ErrorPresentation\ErrorPresentation;
use SwivlBundle\Presentation\ErrorPresentation\ErrorPresentationFactoryInterface;
use SwivlBundle\Presentation\ErrorPresentation\Exception\UnsupportedExceptionTypeException;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * Class ValidationErrorPresentationFactory
 */
class ValidationErrorPresentationFactory implements ErrorPresentationFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(\Exception $exception)
    {
        if (!($exception instanceof ValidationFailedException)) {
            throw new UnsupportedExceptionTypeException();
        }

        $errorRepresentations = [];
        /** @var ConstraintViolationInterface $violation */
        foreach ($exception->getViolationList() as $violation) {
            $errorRepresentations[] = new CommonErrorPresentation(
                $violation->getMessage(),
                $violation->getPropertyPath()
            );
        }

        return new ErrorPresentation(
            new CommonErrorPresentation($exception->getMessage(), null, $errorRepresentations),
            400
        );
    }
}