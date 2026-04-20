<?php

$header = <<<'EOF'
PHP CS Fixer for Reyesoft projects
EOF;

$project_name = $project_name ?? '';

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        // '@PSR2' => true, // cool, but add break lines on every fucntion with 1+ params
        'array_syntax' => ['syntax' => 'short'],
        'comment_to_phpdoc' => [
            'ignored_tags' => [
                // code coverage don't work with phpdoc, so we need to ignore these tags
                'codeCoverageIgnoreStart',
                'codeCoverageIgnoreEnd',
            ],
        ],
        'general_phpdoc_annotation_remove' => [
            'annotations' => [
                'expectedException', 'expectedExceptionMessage', 'expectedExceptionMessageRegExp'
            ],
        ],
        'method_argument_space' => [
            'on_multiline' => 'ignore'
        ],
        'no_useless_return' => true,
        'simplified_null_return' => true,
        'static_lambda' => false,
        'string_implicit_backslashes' => true,
        'trailing_comma_in_multiline' => [
            'elements' => ['arguments', 'arrays', 'parameters']
        ],
        'use_arrow_functions' => true,
        'backtick_to_shell_exec' => true,
        'multiline_comment_opening_closing' => true,
        'ternary_to_null_coalescing' => true,
        'concat_space' => ['spacing' => 'one'],
        'class_definition' => ['single_line' => true, 'single_item_single_line' => true],
        'yoda_style' => false,
        'class_attributes_separation' => ['elements' => ['method' => 'one']],
        'explicit_indirect_variable' => true,
        'phpdoc_align' => ['align' => 'left'],
        'linebreak_after_opening_tag' => true,
        'no_alternative_syntax' => true,
        'date_time_immutable' => true,  // ver implicancias de este cambio
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
        'modernize_types_casting' => false,
        'no_unset_on_property' => false,    // set model property=null is sent to DB
        'psr_autoloading' => true,
        'phpdoc_order' => true,

        'phpdoc_to_return_type' => true,
        'native_function_invocation' => ['include' => []], // count -> \count (added like Symfony:risky)
        'native_constant_invocation' => false, // PHP_EOL -> \PHP_EOL (added like Symfony:risky)
        'single_line_throw' => false,
        'phpdoc_types_order' => ['null_adjustment' => 'always_last', 'sort_algorithm' => 'none'],
        'phpdoc_add_missing_param_annotation' => false,

        // disable fix php docs on single line like /** @var XXX $xxx */
        'phpdoc_to_comment' => false,

        'php_unit_test_case_static_method_calls' => ['call_type' => 'this'],

        'blank_line_before_statement' => [
            'statements' => [
                // 'break',
                'continue',
                'declare',
                'return',
                'throw',
                'try',
            ],
        ],
        'ordered_class_elements' => [
            'order' => [
                'use_trait',
                /*
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
                */
            ],
        ],

        'header_comment' => [
            'header' =>
                "Copyright (C) 1997-2020 Reyesoft <info@reyesoft.com>.\n".
                "\n".
                "This file is part of ".($project_name ? $project_name.'. '.$project_name : 'Reyesoft project and').
                " can not be copied and/or\n".
                "distributed without the express permission of Reyesoft",
            'comment_type' => 'PHPDoc',
            'location' => 'after_open',
            'separate' => 'bottom'
        ],
        'blank_line_after_opening_tag' => false,
    ])
    ->setCacheFile('resources/.tmp/.php_cs.cache')
    ;
