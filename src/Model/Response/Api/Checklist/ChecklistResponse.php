<?php

namespace App\Model\Response\Api\Checklist;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ChecklistResponse
 * @package App\Model\Response\Api\Checklist
 */
class ChecklistResponse
{
    /**
     * @var string
     *
     * @Serializer\Groups({"check"})
     * @Serializer\Type(name="string")
     */
    protected $content = '';

    /**
     * @var int
     *
     * @Serializer\Groups({"check"})
     * @Serializer\Type(name="int")
     */
    protected $keywordsUsed = 0;

    /**
     * @var float
     *
     * @Serializer\Groups({"check"})
     * @Serializer\Type(name="float")
     */
    protected $averageKeywordsDensity = 0;

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return float
     */
    public function getKeywordsUsed(): float
    {
        return $this->keywordsUsed;
    }

    /**
     * @param int $keywordsUsed
     *
     * @return self
     */
    public function setKeywordsUsed(int $keywordsUsed): self
    {
        $this->keywordsUsed = $keywordsUsed;

        return $this;
    }

    /**
     * @return float
     */
    public function getAverageKeywordsDensity(): float
    {
        return $this->averageKeywordsDensity;
    }

    /**
     * @param float $averageKeywordsDensity
     *
     * @return self
     */
    public function setAverageKeywordsDensity(float $averageKeywordsDensity): self
    {
        $this->averageKeywordsDensity = $averageKeywordsDensity;

        return $this;
    }
}