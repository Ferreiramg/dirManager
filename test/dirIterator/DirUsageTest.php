<?php

namespace dirIterator;

/**
 * Description of TestDirUsage
 *
 * @author Luis Paulo
 */
class DirUsageTest extends \PHPUnit_Framework_TestCase {

    public function testReturnDirectoryIteratorInstance() {
        $dir = new dirUsage('\\');

        $this->assertInstanceof('DirectoryIterator', $dir->getIterator());
        $dir->recursive = true;
        $this->assertInstanceof('RecursiveIteratorIterator', $dir->getIterator());
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage Directory name must not be empty.
     */
    public function testRuntimeException() {
        $dir = new dirUsage('');
        $dir->getIterator();
    }

    public function testIteratorsFilterUsage() {

        $dir = new dirUsage(DIRECTORY_SEPARATOR, true);

        $iterator = $dir->getIterator();
        $filter = new Filters\ExtensionFilter($iterator, 'php', false);

        $filter2 = new Filters\ListByType($iterator, 'dir');

        $filter3 = new Filters\MatchFilter($iterator, '*.php');

        $filter4 = new Filters\IsEqual($iterator, 'qualquer');

        $this->assertInstanceof('Iterator', $filter);
        $this->assertInstanceof('Iterator', $filter2);
        $this->assertInstanceof('Iterator', $filter3);
        $this->assertInstanceof('Iterator', $filter4);
    }

    public function testActionDeleteForFilters() {
        for ($i = 0; $i <= 10; ++$i) {
            file_put_contents(__DIR__ . '\tmp\error' . $i . '.log', "empty file");
        }

        $dir = new dirUsage(__DIR__ . '\tmp');
        $filter = new Filters\ListByType($dir->getIterator());

        $filter->next();
        $this->assertEquals($filter->getFileName(), 'error0.log');
        $this->assertTrue($filter->delete());
        $this->assertFileNotExists(__DIR__ . '\tmp\error0.log');
    }

    public function testDeleteAllFiles() {
        $dir = new dirUsage(__DIR__ . '\tmp');
        $filter = new Filters\ListByType($dir->getIterator());

        for ($filter->rewind(); $filter->valid(); $filter->next())
            $r = $filter->delete();
        ;
        $this->asserttrue($r);
        $this->assertFileNotExists(__DIR__ . '\tmp\error10.log');
    }

}