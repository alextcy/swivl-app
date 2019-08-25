<?php

namespace SwivlBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
//use Tonic\Bundle\RestBundle\PresentationLayer\ErrorPresentation\CompositeErrorPresentationFactory;

/**
 * Class ErrorPresentationFactoryCompilerPass
 */
class ErrorPresentationFactoryCompilerPass implements CompilerPassInterface
{
    /**
     * Composite error presentation factory service identifier.
     */
    const COMPOSITE_ERROR_PRESENTATION_FACTORY_SERVICE_ID = 'swivl.composite_error_presentation_factory';

    /**
     * Error presentation factory tag.
     */
    const ERROR_PRESENTATION_FACTORY_TAG = 'swivl.error_presentation_factory';

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
//        if (!$container->hasDefinition(self::COMPOSITE_ERROR_PRESENTATION_FACTORY_SERVICE_ID)) {
//            return;
//        }
//
//        $definition = $container->getDefinition(self::COMPOSITE_ERROR_PRESENTATION_FACTORY_SERVICE_ID);
//
//        if (!is_a($definition->getClass(), CompositeErrorPresentationFactory::class, true)) {
//            throw new \RuntimeException(sprintf('"%s" service is not "%s"', self::COMPOSITE_ERROR_PRESENTATION_FACTORY_SERVICE_ID, CompositeErrorPresentationFactory::class));
//        }
//
//        $taggedServices = $container->findTaggedServiceIds(self::ERROR_PRESENTATION_FACTORY_TAG);
//
//        $methodCalls = [];
//        foreach ($taggedServices as $id => $tags) {
//            $methodCalls[] = ['addFactory', [new Reference($id)]];
//        }
//
//        $definition->setMethodCalls(array_merge($methodCalls, $definition->getMethodCalls()));
    }
}