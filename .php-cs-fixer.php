<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src') 
    ->append([__DIR__ . '/index.php']) 
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new PhpCsFixer\Config();
return $config->setRules([
        '@PSR12' => true,
    ])
    ->setFinder($finder);