<?php

namespace SwivlBundle\Presentation\ErrorPresentation;

use SwivlBundle\Presentation\ErrorPresentation\Exception\UnsupportedExceptionTypeException;
use SwivlBundle\Service\Common\Exception\AbstractModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class LogicErrorPresentationFactory
 */
class LogicErrorPresentationFactory implements ErrorPresentationFactoryInterface
{
    /**
     * Intercept application logic exceptions
     *
     * @param \Exception $exception
     * @return ErrorPresentation|void
     * @throws UnsupportedExceptionTypeException
     */
    public function create(\Exception $exception)
    {
        switch (true) {
            case $exception instanceof NotFoundHttpException:
                $errorPresentation = ErrorPresentation::create($exception->getMessage(), $exception->getStatusCode());
                break;

            case $exception instanceof AbstractModelNotFoundException:
                $errorPresentation = ErrorPresentation::notFound($exception->getMessage());
                break;

            default:
                throw new UnsupportedExceptionTypeException();
        }

        return $errorPresentation;
    }
}