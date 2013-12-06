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

        var_dump($dir);
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

    public function testDeleteAllFiles() {
        $dir = new dirUsage(__DIR__ . '\tmp');
        $filter = new Filters\ListByType($dir->getIterator());

        for ($filter->rewind(); $filter->valid(); $filter->next())
            $r = $filter->delete();
        ;
        $this->asserttrue($r);
        $this->assertFileNotExists(__DIR__ . '\tmp\error10.log');
    }

    public function testDeletEspecifyFilesType() {
        $type = '.txt';
        for ($i = 0; $i <= 5; ++$i) {
            if ($i > 3) {
                $type = '.log';
            }
            file_put_contents(__DIR__ . '\tmp\files' . $i . $type, "empty file");
        }
        ///////////////
        $dir = new dirUsage(__DIR__ . '\tmp');
        $filter = new Filters\ExtensionFilter($dir->getIterator(), ['log'], true); //delete *.log files

        for ($filter->rewind(); $filter->valid(); $filter->next())
            $filter->delete();
        ;
        $this->assertFileNotExists(__DIR__ . '\tmp\files4.log');
        $this->assertFileNotExists(__DIR__ . '\tmp\files5.log');
    }

    public function testDeleteFolder() {
        if (!file_exists(__DIR__ . '\tmp\for_delete'))
            mkdir(__DIR__ . '\tmp\for_delete');
        $dir = new dirUsage(__DIR__ . '\tmp');
        $filter = new Filters\ListByType($dir->getIterator(), 'dir');

        for ($filter->rewind(); $filter->valid(); $filter->next())
            $r = $filter->delete();
        ;
        $this->asserttrue($r);
    }

}
