<?php

/**
 * Description of listByType
 *
 * @author Luis
 */

namespace dirIterator\Filters;

class ListByType extends Filter {

    private $_it;
    public $type = 'file';
    private static $increment = 0;

    public function __construct(\Iterator $iterator, $type = 'file') {
        parent::__construct($iterator);
        $this->_it = $iterator;
        $this->type = $type;
        self::$increment++;
    }

    public function accept() {
        if ($this->_it->getType() === $this->type) {
            return true;
        }
        return false;
    }

    public function count() {
        return self::$increment;
    }

}