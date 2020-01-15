<?php

declare(strict_types=1);

namespace Prometee\SwaggerClientBuilder\PhpBuilder\Classes\Other;

use Prometee\SwaggerClientBuilder\PhpBuilder\BuilderInterface;

interface TraitsBuilderInterface extends BuilderInterface
{
    /**
     * @param UsesBuilderInterface $usesBuilder
     * @param string[] $traits
     */
    public function configure(UsesBuilderInterface $usesBuilder, array $traits = []): void;

    /**
     * @param string $name
     * @param string|null $alias
     */
    public function setTrait(string $name, ?string $alias = null): void;

    /**
     * @param string $name
     * @param string|null $alias
     */
    public function addTrait(string $name, ?string $alias = null): void;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasTrait(string $name): bool;
}