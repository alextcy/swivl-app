<?php

namespace SwivlBundle\Presentation\ErrorPresentation;

use SwivlBundle\Presentation\ErrorPresentation\Exception\UnsupportedExceptionTypeException;

/**
 * Interface ErrorPresentationFactoryInterface
 */
interface ErrorPresentationFactoryInterface
{
    /**
     * Error presentation creator for custom exception.
     *
     * @param \Exception $exception
     *
     * @return ErrorPresentation
     *
     * @throws UnsupportedExceptionTypeException
     */
    public function create(\Exception $exception);
}