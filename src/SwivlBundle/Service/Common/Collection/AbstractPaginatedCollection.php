<?php

namespace SwivlBundle\Service\Common\Collection;

/**
 * Class AbstractPaginatedCollection
 */
abstract class AbstractPaginatedCollection extends AbstractCollection implements \Iterator, \Countable
{
    /**
     * @var int
     */
    protected $limit;

    /**
     * @var int
     */
    protected $offset;

    /**
     * @var int
     */
    protected $totalItems;

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getTotalItems(): int
    {
        return $this->totalItems;
    }
}