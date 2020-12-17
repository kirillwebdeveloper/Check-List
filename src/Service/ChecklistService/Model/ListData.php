<?php

namespace App\Service\ChecklistService\Model;

/**
 * Class ListData
 * @package App\Service\ChecklistService\Model
 */
class ListData implements \Iterator, \Countable
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var int
     */
    private $position = 0;

    /**
     * ListData constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->position = 0;
        $this->data     = $data;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->data[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return isset($this->data[$this->position]);
    }

        /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function count()
    {
        return count($this->data);
    }
}