<?php

namespace App\Model\Request\Api\Checklist;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ChecklistRequest
 * @package App\Model\Request\Api\Checklist
 */
class ChecklistRequest
{
    /**
     * @var string
     *
     * @Assert\NotBlank
     *
     * @Serializer\Groups({"check"})
     * @Serializer\Type(name="string")
     */
    protected $list;

    /**
     * @var string
     *
     * @Assert\NotBlank
     *
     * @Serializer\Groups({"check"})
     * @Serializer\Type(name="string")
     */
    protected $content;

    /**
     * @return string
     */
    public function getList(): string
    {
        return $this->list;
    }

    /**
     * @param string $list
     *
     * @return self
     */
    public function setList(string $list): self
    {
        $this->list = $list;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
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
}