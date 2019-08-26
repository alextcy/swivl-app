<?php

namespace SwivlBundle\Controller;

use SwivlBundle\Presentation\ResponsePresentationInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface ApplicationResponseInterface
 */
interface ApplicationResponseInterface
{
    /**
     * @return ResponsePresentationInterface|null
     */
    public function getData(): ?ResponsePresentationInterface;

    /**
     * @return Response
     */
    public function getResponse();
}