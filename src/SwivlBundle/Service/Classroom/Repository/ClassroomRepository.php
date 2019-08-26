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

    /**
     * @param Classroom $classroom
     */
    public function save(Classroom $classroom): void
    {
        $this->entityManager->persist($classroom);
        $this->entityManager->flush();
    }

    /**
     * @param Classroom $classroom
     */
    public function remove(Classroom $classroom): void
    {
        $this->entityManager->remove($classroom);
        $this->entityManager->flush();
    }

    /**
     * @param array $criteria
     *
     * @return null|Classroom
     */
    public function findOneBy(array $criteria): ?Classroom
    {
        return $this->entityRepository->findOneBy($criteria);
    }
}