<?php

namespace ride\library;

use PHPUnit\Framework\TestCase;

class AutoloaderTest extends TestCase {

    public function testAddIncludePathsAddsPhpIncludePathsWhenNullProvided() {
        $autoloader = new Autoloader();
        $autoloader->addIncludePaths();

        $this->assertEquals($autoloader->getIncludePaths(), explode(PATH_SEPARATOR, get_include_path()));
    }

}
