<?php

namespace SwivlBundle\Service\Classroom\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\Classroom\Model\Collection\ClassroomPaginatedCollection;
use SwivlBundle\Service\Classroom\Repository\Filter\ClassroomSearchFilter;
use SwivlBundle\Service\Classroom\Repository\Paginator\PaginatorFactory;

/**
 * Class ClassroomRepository
 */
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
     * @var PaginatorFactory
     */
    private $paginatorFactory;

    /**
     * @param EntityManagerInterface $entityManager
     * @param EntityRepository $entityRepository
     * @param PaginatorFactory $paginatorFactory
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        EntityRepository $entityRepository,
        PaginatorFactory $paginatorFactory
    ) {
        $this->entityManager = $entityManager;
        $this->entityRepository = $entityRepository;
        $this->paginatorFactory = $paginatorFactory;
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

    /**
     * @param ClassroomSearchFilter $filter
     *
     * @return ClassroomPaginatedCollection
     */
    public function search(ClassroomSearchFilter $filter): ClassroomPaginatedCollection
    {
        $qbClassroom = $this->getClassroomQueryBuilder();

        $qbClassroom->orderBy('c.updatedAt', 'asc')
            ->setFirstResult($filter->getOffset())
            ->setMaxResults($filter->getLimit());

        $paginator = $this->paginatorFactory->create($qbClassroom);

        return new ClassroomPaginatedCollection(
            $filter->getLimit(),
            $filter->getOffset(),
            $paginator->count(),
            ...$paginator->getIterator()->getArrayCopy()
        );
    }

    /**
     * @return QueryBuilder
     */
    private function getClassroomQueryBuilder() : QueryBuilder
    {
        return $this->entityManager->createQueryBuilder()
            ->select('c')
            ->from(Classroom::class, 'c');
    }
}