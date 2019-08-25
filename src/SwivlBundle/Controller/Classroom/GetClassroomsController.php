<?php

namespace SwivlBundle\Controller\Classroom;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route(service="swivl.controller.get_classrooms")
 */
class GetClassroomsController extends Controller
{
    /**
     * @Route("/classrooms", name="get_classrooms", methods={"GET"})
     *
     * return JsonResponse
     */
    public function getClassrooms(): JsonResponse
    {
        return new JsonResponse([['test1' => 'val1'], ['test2' => 'val2']]);
    }
}