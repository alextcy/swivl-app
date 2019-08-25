<?php

namespace SwivlBundle\Controller\Classroom;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetClassroomsController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @Route("/classrooms", name="get_classrooms", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function getClassRooms(): JsonResponse
    {
        return new JsonResponse([['test1' => 'val1'], ['test2' => 'val2']]);
    }
}