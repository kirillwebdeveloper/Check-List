<?php

namespace App\Service\ChecklistService;

use App\Model\Request\Api\Checklist\ChecklistRequest;
use App\Model\Response\Api\Checklist\ChecklistResponse;
use App\Service\ChecklistService\Checker\CheckerInterface;
use App\Service\ChecklistService\Converter\ListConverterInterface;
use App\Service\ChecklistService\Exception\ServiceExpectException;

/**
 * Class AbstractChecker
 * @package App\Service\ChecklistService
 */
abstract class AbstractChecker
{
    /**
     * @var ListConverterInterface
     */
    protected $listConverter = null;

    /**
     * @var CheckerInterface
     */
    protected $checker = null;

    /**
     * @param ListConverterInterface $listConverter
     *
     * @return self
     */
    public function setListConverter(ListConverterInterface $listConverter): self
    {
        $this->listConverter = $listConverter;

        return $this;
    }

    /**
     * @param CheckerInterface $checker
     * @return self
     */
    public function setChecker(CheckerInterface $checker): self
    {
        $this->checker = $checker;

        return $this;
    }

    /**
     * @param ChecklistRequest $checklistRequest
     * @return ChecklistResponse
     * @throws ServiceExpectException
     */
    public function check(ChecklistRequest $checklistRequest): ChecklistResponse
    {
        if (
            null === $this->checker ||
            null === $this->listConverter
        ) {
            throw new ServiceExpectException();
        }

        return $this->buildCheck($checklistRequest);
    }

    /**
     * @param ChecklistRequest $checklistRequest
     * @return ChecklistResponse
     */
    abstract protected function buildCheck(ChecklistRequest $checklistRequest): ChecklistResponse;
}