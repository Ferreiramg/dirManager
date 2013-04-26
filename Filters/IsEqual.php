<?php

/**
 * Description of IsEqual
 *
 * @author Luis Paulo
 */

namespace dirIterator\Filters;

class IsEqual extends Filter {

    private $iterator, $filter;
    private static $ponter = 0;

    public function __construct(\Iterator $iterator, $filter) {
        $this->iterator = $iterator;
        $this->filter = $filter;
        self::$ponter++;

        parent::__construct($iterator);
    }

    public function accept() {
        if (strcasecmp($this->iterator->currentElement[0], $this->filter) == 0)
            return true;
        return false;
    }

    public function count() {
        return self::$ponter;
    }

}

