<?php

namespace dirIterator\Filters;

abstract class Filter extends \FilterIterator {

    protected $_it;

    abstract public function count();

    public function delete() {
        return unlink($this->_it->getPathName());
    }

}