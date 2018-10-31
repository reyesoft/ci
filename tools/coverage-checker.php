<?php
/**
 * Copyright (C) 1997-2018 Reyesoft <info@reyesoft.com>.
 *
 * This file is part of JsonApiPlayground. JsonApiPlayground can not be copied and/or
 * distributed without the express permission of Reyesoft
 */

declare(strict_types=1);

$config = [
    'file' => 'clover.xml',
    'thresholds' => [
        'global' => [
            'lines' => 100,
            '_elements' => 0,
            '_covered' => 0
        ]
    ]
];

// LOAD PARAMS FROM PHPUNIT.XML
$xml = json_decode(file_get_contents('composer.json')) or die("Error reading phpunit.xml");
//var_dump($xml->extra->coverage->thresholds);exit;
foreach ($xml->extra->coverage->thresholds ?? [] as $key => $threshold) {
    @$config['thresholds'][$key]['lines'] = (string) $threshold->lines;
    @$config['thresholds'][$key]['functions'] = (string) $threshold->functions;
}

// merge params
$config['file'] = $argv[1] ?? $xml->extra->coverage->file ?? $config['file'];
$config['file'] = getcwd() . '/' . $config['file'];
if (!file_exists($config['file'])) {
    throw new InvalidArgumentException('Invalid input file provided (' . $config['file'] . ')');
}

$config['thresholds']['global']['lines'] = $argv[2] ?? $config['thresholds']['global']['lines'];
if (!$config['thresholds']['global']['lines']) {
    throw new InvalidArgumentException('An integer checked percentage must be given as second parameter');
}

// READ CLOVER FILE
$xml = new SimpleXMLElement(file_get_contents($config['file']));
$files = $xml->xpath('//file');
foreach ($files as $file) {
    $filename = (string)$file->attributes()->name;

    $elements = (int) $file->metrics->attributes()->elements;
    $covered = (int) $file->metrics->attributes()->coveredelements;

    foreach ($config['thresholds'] as $filepattern => $values) {
        if (strpos($filename, getcwd().$filepattern) === 0 || strpos($filename, $filepattern) === 0) {
            @$config['thresholds'][$filepattern]['_elements'] += $elements;
            @$config['thresholds'][$filepattern]['_covered'] += $covered;
        }
    }

    $config['thresholds']['global']['_elements'] += $elements;
    $config['thresholds']['global']['_covered'] += $covered;
}

echo PHP_EOL .
    ' 👉  Check file://' . getcwd() . '/bootstrap/cache/reports/coverage/index.html for more information'
    . PHP_EOL . PHP_EOL;


$error = false;
foreach ($config['thresholds'] as $filepattern => $values) {
    $config['thresholds'][$filepattern]['_percentage'] = intval(
            intval($config['thresholds'][$filepattern]['_covered'] ?? 0)
            / intval($config['thresholds'][$filepattern]['_elements'] ?? 1)
            * 10000) / 100;
    if ($config['thresholds'][$filepattern]['_percentage'] < $config['thresholds'][$filepattern]['lines']) {
        echo 'FAIL: '.$filepattern.' coverage '.$config['thresholds'][$filepattern]['_percentage']
            . '; ' .$config['thresholds'][$filepattern]['lines'].' required.'. PHP_EOL;
        $error = true;
    }
}

$coverage = intval($config['thresholds']['global']['_covered'] / $config['thresholds']['global']['_elements'] * 10000) / 100;

if ($error || $coverage < $config['thresholds']['global']['lines']) {
    echo PHP_EOL
        . "\033[0;30m\033[43m"   // white on yellow
        . ' ⚠ ERROR: Global code coverage is ' . $coverage . '%, which is below the accepted ' . $config['thresholds']['global']['lines'] . '% '
        . "\033[0m"
        . PHP_EOL . PHP_EOL;
    exit(1);
}

echo "\033[0;32m" // green
    . ' ✓  Global code coverage is ' . $coverage . '% 👌'
    . "\033[0m"
    . PHP_EOL . PHP_EOL;
