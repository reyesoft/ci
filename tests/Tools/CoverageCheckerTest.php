<?php
/**
 * Copyright (C) 1997-2018 Reyesoft <info@reyesoft.com>.
 *
 * This file is part of LaravelJsonApi. LaravelJsonApi can not be copied and/or
 * distributed without the express permission of Reyesoft
 */

declare(strict_types=1);

namespace Tests\Tools;

use PHPUnit\Framework\TestCase;

class CoverageCheckerTest extends TestCase
{
    public function testCoverageReportByFolder(): void
    {
        $output = `php ./tools/coverage-checker.php ./tests/Tools/coverage-checker-files/clover.xml`;
        $this->assertContains('for more information', $output);
        $this->assertNotContains('which is below the accepted', $output);
    }

    public function testCoverageReportFail(): void
    {
        $output = `php ./tools/coverage-checker.php ./tests/Tools/coverage-checker-files/clover.xml 99`;
        $this->assertContains('for more information', $output);
        $this->assertContains('which is below the accepted', $output);
    }

    public function testCoverageReportOk(): void
    {
        $output = `php ./tools/coverage-checker.php ./tests/Tools/coverage-checker-files/clover.xml 55`;
        $this->assertContains('for more information', $output);
        $this->assertNotContains('which is below the accepted', $output);
    }

    public function testCoverageReportWarn(): void
    {
        $output = `php ./tools/coverage-checker.php`;
        $this->assertContains('WARN: /app/Boxer functions coverage 75.32; 55 required. You can increase it', $output);
        $this->assertNotContains('which is below the accepted', $output);
    }
}
