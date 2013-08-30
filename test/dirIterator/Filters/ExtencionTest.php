<?php

namespace dirIterator\Filters;

/**
 * Description of ExtencionTest
 *
 * @author Luís Paulo <lpdeveloper@hotmail.com.br>
 * @version 1.0
 */
class ExtencionTest extends \PHPUnit_Framework_TestCase {

    public function testAcceptValues() {

        $dir = new \dirIterator\dirUsage(dirname(__DIR__) . '\tmp');
        $filter = new ExtensionFilter($dir->getIterator(), ['js', 'php'], true);

        $filter->next();
        $this->assertTrue($filter->accept());
        $this->assertTrue($filter->valid());
    }

}