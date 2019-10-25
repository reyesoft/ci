<?php
/**
 * Copyright (C) 1997-2018 Reyesoft <info@reyesoft.com>.
 *
 * This file is part of Multinexo. Multinexo can not be copied and/or
 * distributed without the express permission of Reyesoft
 */

declare(strict_types=1);

namespace Reyesoft\Ci\Tests;

use Illuminate\Support\Facades\DB;

/**
 * If this are used on parent class:
 * - comment if self::$tests_total
 *     use TestCaseDatabaseTransactionTrait {
 *          setUp as protected setUpTransaction;
 *     }
 * - you will be have a problem with app_cache (UNSOLVED).
 */

/**
 * @property \Illuminate\Contracts\Foundation\Application|null $app
 * @method createApplication() prevent error phpStorm CreateApplicationTrait implement
 * @mixin \Illuminate\Foundation\Testing\TestCase
 */
trait TestCaseDatabaseTransactionTrait
{
    protected static $tests_total = null;
    protected static $app_backup = null;

    protected function setUp(): void
    {
        if (self::$app_backup) {
            $this->app = self::$app_backup;
        }
        parent::setUp();
        $this->beginTransactionIfIsNeccessary();
        self::$app_backup = $this->app;
    }

    protected function tearDown(): void
    {
        $this->rollbackTransactionIfIsNeccessary();
        $app = $this->app;
        $this->app = null;
        parent::tearDown();
        $this->app = $app;
    }

    protected function beginTransactionIfIsNeccessary(): void
    {
        // fwrite(STDERR, "\n".'setup: ' . $this->getTestsRunCount() . '/' . $this->getTestsTotalCount() . ' ');
        if ($this->getTestsRunCount() !== 1) {
            return;
        }
        // fwrite(STDERR, '(begin) ');
        DB::beginTransaction();
    }

    protected function rollbackTransactionIfIsNeccessary(): void
    {
        if ($this->getTestsRunCount() !== $this->getTestsTotalCount()) {
            return;
        }
        // fwrite(STDERR, "\n".'(rollback) ');
        DB::rollBack();

        // prevent Mysql Too many connections error
        DB::connection()->disconnect();
    }

    protected function getTestsTotalCount(): int
    {
        if (self::$tests_total === null) {
            //fwrite(STDERR, "\n\n".'recalculating... '."\n\n");
            self::$tests_total = 0;
            $class = new \ReflectionClass(static::class);
            $methods = $class->getMethods(\ReflectionMethod::IS_FINAL | \ReflectionMethod::IS_PUBLIC);
            foreach ($methods as $method) {
                if (preg_match('/^test/', $method->name) !== 1) {
                    continue;
                }
                ++self::$tests_total;
            }
        }

        return self::$tests_total;
    }

    protected function getTestsRunCount(): int
    {
        if ($this->getTestResultObject() === null) {
            return 0;
        }

        $count = 1;
        $search = get_class($this) . '::';
        foreach ($this->getTestResultObject()->passed() as $key => $value) {
            if (substr((string) $key, 0, strlen($search)) !== $search) {
                continue;
            }
            ++$count;
        }

        return $count;
    }
}
