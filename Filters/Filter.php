<?php

namespace Filters;

abstract class Filter extends \FilterIterator {

    abstract public function count();
}