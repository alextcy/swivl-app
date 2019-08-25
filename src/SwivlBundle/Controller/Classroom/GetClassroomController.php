<?php

namespace SwivlBundle\Controller\Classroom;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetClassroomController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @Route(
     *     "/classrooms/{id}",
     *     requirements={"id": "\d+"},
     *     name="get_classroom",
     *     methods={"GET"}
     * )
     *
     * @return JsonResponse
     */
    public function getClassRoom(): JsonResponse
    {
        return new JsonResponse(['test' => 'val']);
    }
}