<?php

/**
 * Description of MatchFilter
 *
 * @author Luis Paulo
 */

namespace dirIterator\Filters;

class MatchFilter extends Filter {

    private $match;

    public function __construct(\Iterator $iterator, $matchs = '') {
        parent::__construct($iterator);
        $this->_it = $iterator;
        $this->match = $matchs;
        self::$increment++;
    }

    public function accept() {
        if (fnmatch($this->match, $this->_it->getFilename()))
            return true;
        return false;
    }

    public function count() {
        return self::$increment;
    }

}
