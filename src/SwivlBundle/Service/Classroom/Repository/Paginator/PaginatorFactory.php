<?php

namespace SwivlBundle\Service\Classroom\Repository\Paginator;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class PaginatorFactory
 */
class PaginatorFactory
{
    /**
     * @param QueryBuilder $queryBuilder
     * @return Paginator
     */
    public function create(QueryBuilder $queryBuilder): Paginator
    {
        return new Paginator($queryBuilder, false);
    }
}