<?php

namespace SwivlBundle\Service\Classroom\Repository\Filter;

/**
 * Class ClassroomSearchFilter
 */
class ClassroomSearchFilter
{
    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $offset;

    /**
     * @return int
     */
    public function getLimit(): ? int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     *
     * @return ClassroomSearchFilter
     */
    public function setLimit(int $limit) : ClassroomSearchFilter
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @return int
     */
    public function getOffset(): ? int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     *
     * @return ClassroomSearchFilter
     */
    public function setOffset(int $offset): ClassroomSearchFilter
    {
        $this->offset = $offset;

        return $this;
    }

}