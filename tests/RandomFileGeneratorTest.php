<?php

namespace Siestacat\RandomFileGenerator\Tests;
use PHPUnit\Framework\TestCase;
use Siestacat\RandomFileGenerator\RandomFileGenerator;

class RandomFileGeneratorTest extends TestCase
{
    public function test(): void
    {
        $file_path = RandomFileGenerator::generate();

        $this->assertTrue(is_file($file_path) && is_readable($file_path));

        $this->assertEquals(RandomFileGenerator::DEFAULT_FILE_SIZE, filesize($file_path));
    }
}