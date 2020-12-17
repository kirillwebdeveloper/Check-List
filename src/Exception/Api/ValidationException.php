<?php

namespace App\Exception\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Validation Exception
 *
 * Class ValidationException
 * @package App\Exception\Api
 */
class ValidationException extends ApiException
{
    /**
     * @var int
     */
    protected $code = Response::HTTP_UNPROCESSABLE_ENTITY;

    /**
     * @var ConstraintViolationListInterface
     */
    protected $constraintViolations;

    /**
     * ValidationException constructor.
     *
     * @param ConstraintViolationListInterface $constraintViolations
     */
    public function __construct(ConstraintViolationListInterface $constraintViolations)
    {
        $this->constraintViolations = $constraintViolations;
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getConstraintViolations(): ConstraintViolationListInterface
    {
        return $this->constraintViolations;
    }
}