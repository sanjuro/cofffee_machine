<?php

/**
 * AutoLoader class used from the Web, I did not write it but as the test is not about autoloading I assumed it
 * might be acceptable. If not acceptable, I will write my own one.
 *
 */
class AutoLoader {
     
    static private $classNames = array();
     
    public static function registerDirectory($dirName) {
     
        $di = new DirectoryIterator($dirName);
        foreach ($di as $file) {
         
            if ($file->isDir() && !$file->isLink() && !$file->isDot()) {
                // recurse into directories other than a few special ones
                self::registerDirectory($file->getPathname());
            } elseif (substr($file->getFilename(), -4) === '.php') {
                // save the class name / path of a .php file found
                $className = substr($file->getFilename(), 0, -4);
                AutoLoader::registerClass($className, $file->getPathname());
            }
        }
    }
         
    public static function registerClass($className, $fileName) {
        AutoLoader::$classNames[$className] = $fileName;
    }
         
     public static function loadClass($className) {
        if (isset(AutoLoader::$classNames[$className])) {
            require_once(AutoLoader::$classNames[$className]);
        }
    }
         
}
     
spl_autoload_register(array('AutoLoader', 'loadClass'));