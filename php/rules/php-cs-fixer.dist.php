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
        // '@PSR2' => true, // cool, but add break lines on every fucntion with 1+ params
        '@PHPUnit60Migration:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
        'combine_consecutive_unsets' => true,
        'general_phpdoc_annotation_remove' => ['expectedException', 'expectedExceptionMessage', 'expectedExceptionMessageRegExp'],
        'no_short_echo_tag' => true,
        'no_unreachable_default_argument_value' => true,
        'no_useless_return' => true,
        'simplified_null_return' => true,
        'backtick_to_shell_exec' => true,
        'multiline_comment_opening_closing' => true,
        'escape_implicit_backslashes' => true,
        'braces' => ['allow_single_line_closure' => true],
        'ordered_imports' => true,
        'no_unused_imports' => true,
        'semicolon_after_instruction' => true,
        'ternary_to_null_coalescing' => true,
        'binary_operator_spaces' => true,
        'single_blank_line_before_namespace' => true,
        'random_api_migration' => true,
        'concat_space' => ['spacing' => 'one'],
        'class_definition' => ['singleLine' => true, 'singleItemSingleLine' => true],
        'yoda_style' => false,
        'combine_consecutive_issets' => true,
        'no_homoglyph_names' => true,
        'method_separation' => true,
        'explicit_indirect_variable' => true,
        'phpdoc_align' => ['align' => 'left'],
        'align_multiline_comment' => true,
        'compact_nullable_typehint' => true,
        'linebreak_after_opening_tag' => true,
        'method_chaining_indentation' => true,
        'multiline_whitespace_before_semicolons' => true,
        'no_alternative_syntax' => true,
        'php_unit_ordered_covers' => true,
        'php_unit_construct' => true,
        'php_unit_strict' => true,
        'string_line_ending' => true,
        'php_unit_set_up_tear_down_visibility' => true,
        'function_to_constant' => true,
        'magic_constant_casing' => true,
        'single_quote' => true,
        'fully_qualified_strict_types' => true,
        'date_time_immutable' => true,  // ver implicancias de este cambio
        'array_indentation' => true,

        /* PHP 7.0 */
        '@PHP70Migration:risky' => true,

        /* PHP 7.1 */
        '@PHP71Migration' => true,
        '@PHP71Migration:risky' => true,
        'declare_strict_types' => true,

        /* php-cs-fixer 2.12 */
        'return_assignment' => true,
        'phpdoc_to_return_type' => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'set_type_to_cast' => true,
        'no_superfluous_phpdoc_tags' => true,
        'no_binary_string' => true,
        // 'no_unset_on_property' => true, // Warning: we use unset on StdClass
        // 'php_unit_internal_class' => true,

        'explicit_string_variable' => true, //check classes like $user->first_name
        'strict_comparison' => true,
        'no_useless_else' => true,
        'strict_param' => true,

        // 2.13
        'native_function_invocation' => ['include' => []], // count -> \count (added like Symfony:risky)
        'native_constant_invocation' => false, // PHP_EOL -> \PHP_EOL (added like Symfony:risky)
        'magic_method_casing' => true,
        'fopen_flag_order' => true,
        'combine_nested_dirname' => true,
        'binary_operator_spaces' => true,
        'no_alias_functions' => true,
        'php_unit_method_casing' => true,
        'implode_call' => true,
        'no_unreachable_default_argument_value' => true,

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
