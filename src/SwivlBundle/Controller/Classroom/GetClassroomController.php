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
     *     "/classrooms/{classroom_id}",
     *     requirements={"account_id": "\d+", "classroom_id": "\d+"},
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