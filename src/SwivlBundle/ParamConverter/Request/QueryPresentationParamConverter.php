<?php

namespace SwivlBundle\ParamConverter\Request;

use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use SwivlBundle\Presentation\QueryPresentationInterface;

/**
 * Class QueryPresentationParamConverter
 */
class QueryPresentationParamConverter implements ParamConverterInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(ParamConverter $configuration)
    {
        // supports if parameter is query representation
        return
            ($configuration instanceof ParamConverter)
            && (null !== $configuration->getClass())
            && is_a($configuration->getClass(), QueryPresentationInterface::class, true)
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $object = $this->deserialize($request->query, $configuration->getClass());
        $request->attributes->set($configuration->getName(), $object);

        return true;
    }

    /**
     * Deserialize query into object (simple workaround).
     *
     * @param ParameterBag $query
     * @param string       $class
     *
     * @return QueryPresentationInterface
     */
    public function deserialize(ParameterBag $query, $class): QueryPresentationInterface
    {
        return $this->serializer->deserialize(json_encode($query->all()), $class, 'json');
    }
}