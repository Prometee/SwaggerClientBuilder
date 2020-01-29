<?php

declare(strict_types=1);

namespace Prometee\SwaggerClientGenerator\Swagger\Generator\Factory;

use Prometee\SwaggerClientGenerator\Base\Generator\Factory\MethodFactoryInterface as BaseMethodFactoryInterface;
use Prometee\SwaggerClientGenerator\Base\Generator\Object\Other\UsesGeneratorInterface;
use Prometee\SwaggerClientGenerator\Swagger\Generator\Operation\OperationsMethodGeneratorInterface;

interface OperationsMethodFactoryInterface extends BaseMethodFactoryInterface
{
    /**
     * @param UsesGeneratorInterface $usesBuilder
     *
     * @return OperationsMethodGeneratorInterface
     */
    public function createOperationMethodBuilder(UsesGeneratorInterface $usesBuilder): OperationsMethodGeneratorInterface;
}