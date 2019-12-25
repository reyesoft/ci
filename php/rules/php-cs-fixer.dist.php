<?php

$header = <<<'EOF'
PHP CS Fixer for Reyesoft projects
EOF;

$project_name = $project_name ?? '';

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        // '@PSR2' => true, // cool, but add break lines on every fucntion with 1+ params
        '@PHPUnit60Migration:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
        'general_phpdoc_annotation_remove' => ['expectedException', 'expectedExceptionMessage', 'expectedExceptionMessageRegExp'],
        'no_useless_return' => true,
        'simplified_null_return' => true,
        'backtick_to_shell_exec' => true,
        'multiline_comment_opening_closing' => true,
        'escape_implicit_backslashes' => true,
        'braces' => ['allow_single_line_closure' => true],
        'ternary_to_null_coalescing' => true,
        'concat_space' => ['spacing' => 'one'],
        'class_definition' => ['singleLine' => true, 'singleItemSingleLine' => true],
        'yoda_style' => false,
        'class_attributes_separation' => ['method'],
        'explicit_indirect_variable' => true,
        'phpdoc_align' => ['align' => 'left'],
        'linebreak_after_opening_tag' => true,
        'no_alternative_syntax' => true,
        'date_time_immutable' => true,  // ver implicancias de este cambio

        /* PHP 7.0 */
        '@PHP70Migration' => true,
        '@PHP70Migration:risky' => true,
        '@PHP71Migration' => true,
        '@PHP71Migration:risky' => true,
        '@PHP73Migration' => true,

        'phpdoc_to_return_type' => true,
        'native_function_invocation' => ['include' => []], // count -> \count (added like Symfony:risky)
        'native_constant_invocation' => false, // PHP_EOL -> \PHP_EOL (added like Symfony:risky)
        'single_line_throw' => false,

        /*
        'ordered_class_elements' => [
            'use_trait',
            'constant_public',
            'constant_protected',
            'constant_private',
            'property_public',
            'property_protected',
            'property_private',
            'construct',
            'destruct',
            'magic',
            'phpunit',
            'method_public',
            'method_protected',
            'method_private'
        ],
        */
        'header_comment' => [
            'header' =>
                "Copyright (C) 1997-2018 Reyesoft <info@reyesoft.com>.\n".
                "\n".
                "This file is part of ".($project_name ? $project_name.'. '.$project_name : 'Reyesoft project and').
                " can not be copied and/or\n".
                "distributed without the express permission of Reyesoft",
            'commentType' => 'PHPDoc',
            'location' => 'after_open',
            'separate' => 'bottom'
        ],
    ])
    ->setCacheFile('resources/.tmp/.php_cs.cache')
    ;
