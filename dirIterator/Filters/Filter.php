<?php

namespace dirIterator\Filters;

abstract class Filter extends \FilterIterator {

    abstract public function count();
}