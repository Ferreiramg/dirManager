<?php

/**
 * Description of listByType
 *
 * @author Luis
 */

namespace dirIterator\Filters;

class ListByType extends Filter {

    public $type = 'file';

    public function __construct(\Iterator $iterator, $type = 'file') {
        parent::__construct($iterator);
        $this->_it = $iterator;
        $this->type = $type;
        self::$increment++;
    }

    public function delete() {
        if ($this->type === 'file')
            return parent::delete();
        else {
            if (!$this->_it->isDot())
                return rmdir($this->_it->getPathName());
        }
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