<?php

namespace Dvsa\PhpCodingStandards;

use PhpCsFixer\Config as PhpCsFixerConfig;
use PhpCsFixer\Finder;

class Config
{
    public function __invoke(Finder $finder, array $additionalRules = [], string $cacheFilename = '.php-cs-fixer.cache'): PhpCsFixerConfig
    {
        $rules = array_merge(require __DIR__.'/rules.php', $additionalRules);

        $config = new PhpCsFixerConfig();

        $config->setRules($rules);
        $config->setFinder($finder);
        $config->setRiskyAllowed(true);
        $config->setCacheFile($cacheFilename);

        return $config;
    }
}
