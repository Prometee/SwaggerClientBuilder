<?php

declare(strict_types=1);

namespace Prometee\SwaggerClientGenerator\Base\Generator\Other;

use Prometee\SwaggerClientGenerator\Base\Generator\AbstractGenerator;
use Prometee\SwaggerClientGenerator\Base\Generator\Method\MethodGeneratorInterface;
use Prometee\SwaggerClientGenerator\Base\View\Other\MethodsViewInterface;

class MethodsGenerator extends AbstractGenerator implements MethodsGeneratorInterface
{
    /** @var UsesGeneratorInterface */
    protected $usesGenerator;
    /** @var MethodGeneratorInterface[] */
    protected $methods = [];

    /**
     * @param MethodsViewInterface $methodsView
     */
    public function __construct(
        MethodsViewInterface $methodsView
    )
    {
        $this->setView($methodsView);
    }

    /**
     * {@inheritDoc}
     */
    public function configure(UsesGeneratorInterface $usesGenerator, array $methods = []): void
    {
        $this->usesGenerator = $usesGenerator;
        $this->methods = $methods;
    }

    /**
     * {@inheritDoc}
     */
    public function generate(string $indent = null, string $eol = null): ?string
    {
        $content = '';

        $this->orderMethods();
        foreach ($this->methods as $method) {
            $content .= $method->generate($indent, $eol);
        }

        return $content;
    }

    /**
     * {@inheritDoc}
     */
    public function addMultipleMethod(array $methodGenerators): void
    {
        foreach ($methodGenerators as $methodGenerator) {
            $this->addMethod($methodGenerator);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addMethod(MethodGeneratorInterface $methodGenerator): void
    {
        if (!$this->hasMethod($methodGenerator->getName())) {
            $this->methods[$methodGenerator->getName()] = $methodGenerator;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function orderMethods(): void
    {
        uksort($this->methods, function ($k1, $k2) {
            $o1 = preg_match('#^__#', $k1) === 0 ? 1 : 0;
            $o2 = preg_match('#^__#', $k2) === 0 ? 1 : 0;

            return $o1 - $o2;
        });
    }

    /**
     * {@inheritDoc}
     */
    public function getMethodByName(string $name): ?MethodGeneratorInterface
    {
        if ($this->hasMethod($name)) {
            return $this->methods[$name];
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function hasMethod(string $name): bool
    {
        return isset($this->methods[$name]);
    }

    /**
     * {@inheritDoc}
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * {@inheritDoc}
     */
    public function setMethods(array $methods): void
    {
        $this->methods = $methods;
    }

    /**
     * {@inheritDoc}
     */
    public function getUsesGenerator(): UsesGeneratorInterface
    {
        return $this->usesGenerator;
    }

    /**
     * {@inheritDoc}
     */
    public function setUsesGenerator(UsesGeneratorInterface $usesGenerator): void
    {
        $this->usesGenerator = $usesGenerator;
    }
}
