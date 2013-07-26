<?php

/**
 * Description of IsEqual
 *
 * @author Luis Paulo
 */

namespace dirIterator\Filters;

class IsEqual extends Filter {

    private $filter;
    private static $ponter = 0;

    public function __construct(\Iterator $iterator, $filter) {
        $this->_it = $iterator;
        $this->filter = $filter;
        self::$ponter++;

        parent::__construct($iterator);
    }

    public function accept() {
        if (strcasecmp($this->_it->currentElement[0], $this->filter) == 0)
            return true;
        return false;
    }

    public function count() {
        return self::$ponter;
    }

}

