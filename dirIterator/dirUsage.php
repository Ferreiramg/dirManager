<?php

/**
 * Description of dirUsage
 *
 * @author Luis Paulo
 */

namespace dirIterator;

class dirUsage implements dirInterface {

    public $path = "", $recursive;

    function __construct($path, $recursive = false) {
        $this->path = $path == "/" || $path == "\\" ? __DIR__ : $path;
        $this->recursive = $recursive;
    }

    public function getIterator() {
        try {
            if ($this->recursive)
                return new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->path), \RecursiveIteratorIterator::CHILD_FIRST);
            else
                return new \DirectoryIterator($this->path);
        } catch (\RuntimeException $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }

}