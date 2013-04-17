<?php

/**
 * Description of MatchFilter
 *
 * @author Luis Paulo
 */

namespace Filters;

class MatchFilter extends Filter {

    private $match, $_it;

    public function __construct(\Iterator $iterator, $matchs = '') {
        parent::__construct($iterator);
        $this->_it = $iterator;
        $this->match = $matchs;
    }

    public function accept() {
        if (fnmatch($this->match, $this->_it->getFilename()))
            return true;
        return false;
    }

    public function count() {
        
    }

}
