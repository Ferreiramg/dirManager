<?php

namespace dirIterator\Filters;

abstract class Filter extends \FilterIterator {

    protected $_it;
    protected static $increment = 0;

    abstract public function count();

    public function delete() {
        if (!$this->_it->isDir()) {
            return unlink($this->_it->getPathName());
        }
    }

}
