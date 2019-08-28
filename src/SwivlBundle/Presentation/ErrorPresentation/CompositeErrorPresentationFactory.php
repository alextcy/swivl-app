<?php

namespace SwivlBundle\Presentation\ErrorPresentation;

use SwivlBundle\Presentation\ErrorPresentation\Exception\UnsupportedExceptionTypeException;

/**
 * Class CompositeErrorPresentationFactory
 */
class CompositeErrorPresentationFactory implements ErrorPresentationFactoryInterface
{
    /**
     * @var ErrorPresentationFactoryInterface[]
     */
    private $factoryList = [];

    /**
     * @param ErrorPresentationFactoryInterface $errorPresentationFactory
     *
     * @return CompositeErrorPresentationFactory
     */
    public function addFactory(ErrorPresentationFactoryInterface $errorPresentationFactory)
    {
        $this->factoryList[] = $errorPresentationFactory;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function create(\Exception $exception)
    {
        foreach ($this->factoryList as $errorPresentationFactory) {
            try {
                return $errorPresentationFactory->create($exception);
            } catch (UnsupportedExceptionTypeException $e) {
                continue;
            }
        }

        throw new UnsupportedExceptionTypeException(sprintf(
            'Unsupported exception type "%s"',
            get_class($exception)),
            0,
            $exception
        );
    }
}