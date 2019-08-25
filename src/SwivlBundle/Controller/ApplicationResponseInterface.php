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
     * @return ResponsePresentationInterface
     */
    public function getData();

    /**
     * @return Response
     */
    public function getResponse();
}