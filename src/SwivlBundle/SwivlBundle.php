<?php

namespace SwivlBundle;

use SwivlBundle\DependencyInjection\Compiler\ErrorPresentationFactoryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SwivlBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ErrorPresentationFactoryCompilerPass());
    }
}
