<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\TextUI\XmlConfiguration;

use PHPUnit\TextUI\Configuration\ExtensionBootstrapCollection;
use PHPUnit\TextUI\Configuration\Php;
use PHPUnit\TextUI\Configuration\Source;
use PHPUnit\TextUI\Configuration\TestSuiteCollection;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\CodeCoverage;
use PHPUnit\TextUI\XmlConfiguration\Logging\Logging;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 *
 * @psalm-immutable
 */
final readonly class LoadedFromFileConfiguration extends Configuration
{
    /**
     * @psalm-var non-empty-string
     */
    private string $filename;
    private ValidationResult $validationResult;

    /**
     * @psalm-var list<non-empty-string>
     */
    private array $warnings;

    /**
     * @param non-empty-string       $filename
     * @param list<non-empty-string> $warnings
     */
    public function __construct(string $filename, ValidationResult $validationResult, ExtensionBootstrapCollection $extensions, Source $source, CodeCoverage $codeCoverage, Groups $groups, Logging $logging, Php $php, PHPUnit $phpunit, TestSuiteCollection $testSuite, array $warnings)
    {
        $this->filename         = $filename;
        $this->validationResult = $validationResult;
        $this->warnings         = $warnings;

        parent::__construct(
            $extensions,
            $source,
            $codeCoverage,
            $groups,
            $logging,
            $php,
            $phpunit,
            $testSuite,
        );
    }

    /**
     * @psalm-return non-empty-string
     */
    public function filename(): string
    {
        return $this->filename;
    }

    public function hasValidationErrors(): bool
    {
        return $this->validationResult->hasValidationErrors();
    }

    public function validationErrors(): string
    {
        return $this->validationResult->asString();
    }

    public function wasLoadedFromFile(): bool
    {
        return true;
    }

    public function hasWarnings(): bool
    {
        return !empty($this->warnings);
    }

    /**
     * @psalm-return list<non-empty-string>
     */
    public function warnings(): array
    {
        return $this->warnings;
    }
}
