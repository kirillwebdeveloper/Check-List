<?php

namespace App\Service\ChecklistService\Model;

/**
 * Class CheckInformation
 * @package App\Service\ChecklistService\Model
 */
class CheckInformation
{
    /**
     * @var integer
     */
    protected $wordSumm = 0;

    /**
     * @var int
     */
    protected $wordUsed = 0;

    /**
     * @var float
     */
    protected $average = 0;

    /**
     * @return mixed
     */
    public function getWordSumm()
    {
        return $this->wordSumm;
    }

    /**
     * @param mixed $wordSumm
     *
     * @return self
     */
    public function setWordSumm($wordSumm): self
    {
        $this->wordSumm = $wordSumm;

        return  $this;
    }

    /**
     * @return int
     */
    public function getWordUsed(): int
    {
        return $this->wordUsed;
    }

    /**
     * @param int $wordUsed
     *
     * @return self
     */
    public function setWordUsed(int $wordUsed): self
    {
        $this->wordUsed = $wordUsed;

        return  $this;
    }

    /**
     * @return float
     */
    public function getAverage(): float
    {
        return $this->average;
    }

    /**
     * @param float $average
     *
     * @return self
     */
    public function setAverage(float $average): self
    {
        $this->average = $average;

        return  $this;
    }
}