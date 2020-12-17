<?php

namespace App\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class TestCaseContainer
 * @package App\Tests\Service
 */
class TestCaseContainer extends KernelTestCase
{
    public function setUp()
    {
        parent::setUp();

        self::bootKernel();
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return self::$container;
    }
}