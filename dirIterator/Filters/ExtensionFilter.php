<?php

/**
 * Description of ExtensionFilter
 *
 * @author Luis
 */

namespace dirIterator\Filters;

class ExtensionFilter extends Filter {

    private $_ext, $_it, $_whitelisted;
    private static $ponter = 0;

    public function __construct(\Iterator $it, $ext, $whitelisted = false) {
        parent::__construct($it);
        $this->_it = $it;
        $this->_ext = $ext;
        $this->_whitelisted = $whitelisted;
        self::$ponter++;
    }

    public function accept() {
        $return = true;

        // skip dots
        if ($this->_it->isDot())
            return false;

        // pop off the extension for non-directories and try to match
        if (!$this->_it->isDir()) {
            $ext = $this->_it->getExtension();

            if ($this->_whitelisted) {
                if (is_array($this->_ext)) {
                    $return = in_array($ext, $this->_ext);
                } else {
                    $return = $ext === $this->_ext;
                }
            } else {
                if (is_array($this->_ext)) {
                    $return = !in_array($ext, $this->_ext);
                } else {
                    $return = $ext !== $this->_ext;
                }
            }
        }

        return $return;
    }

    public function count() {
        return self::$ponter;
    }

}
