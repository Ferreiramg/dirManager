<?php

/**
 * Description of TestDirUsage
 *
 * @author Luis Paulo
 */
class TestDirUsage extends \PHPUnit_Framework_TestCase {

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

}