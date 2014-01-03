dirManager
==========

### Usage

```php
<?php 
 $dir = new dirUsage(__DIR__ . '\tmp');
 $filter = new Filters\ListByType($dir->getIterator());

    foreach($filter as $file){
        echo $file->getNameFile();
    } 
?>
```