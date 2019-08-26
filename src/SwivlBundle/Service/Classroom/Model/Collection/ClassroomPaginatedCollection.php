<?php

namespace SwivlBundle\Service\Classroom\Model\Collection;

use SwivlBundle\Service\Classroom\Model\Classroom;
use SwivlBundle\Service\Common\Collection\AbstractPaginatedCollection;

/**
 * Class ClassroomPaginatedCollection
 */
class ClassroomPaginatedCollection extends AbstractPaginatedCollection
{
    /**
     * @param int        $limit
     * @param int        $offset
     * @param int        $totalItems
     * @param Classroom  ...$items
     */
    public function __construct(
        int $limit,
        int $offset,
        int $totalItems,
        Classroom ...$items
    ) {
        $this->items = $items;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->totalItems = $totalItems;
    }
}