<?php

namespace SwivlBundle\Service\Classroom\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use SwivlBundle\Service\Classroom\Model\Classroom;

class ClassroomRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var EntityRepository
     */
    private $entityRepository;

    /**
     * @param EntityManagerInterface $entityManager
     * @param EntityRepository $entityRepository
     */
    public function __construct(EntityManagerInterface $entityManager, EntityRepository $entityRepository)
    {
        $this->entityManager = $entityManager;
        $this->entityRepository = $entityRepository;
    }


    public function save(Classroom $classroom)
    {
        $this->entityManager->persist($classroom);
        $this->entityManager->flush();
    }
}