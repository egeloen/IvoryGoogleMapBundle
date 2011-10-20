<?php

namespace Ivory\GoogleMapBundle\Tests;

/**
 * Util allows to:
 *     - Remove recursivly a directory
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Util 
{
    /**
     * Disable constructor
     */
    public final function __construct()
    {
        throw new \Exception(sprintf('The class "%s" can not be instancited.', get_class($this)));
    }
    
    /**
     * Removes recursivly a directory
     *
     * @param string $directory 
     */
    public static function removeDirectoryRecursilvy($directory)
    {
        if(is_string($directory))
        {
            if(file_exists($directory))
            {
                $objects = scandir($directory);

                foreach($objects as $object)
                {
                    if(($object != '.') && ($object != '..'))
                    {
                        if(filetype($directory.DIRECTORY_SEPARATOR.$object) == 'dir')
                            self::removeDirectoryRecursilvy($directory.DIRECTORY_SEPARATOR.$object);
                        else
                            unlink($directory.DIRECTORY_SEPARATOR.$object);
                    }
                }

                rmdir($directory);
                reset($objects);
            }
            else
                throw new \InvalidArgumentException(sprintf('The directory "%s" does not exist.', $directory));
       }
       else
           throw new \InvalidArgumentException('The directory must be a string value.');
    }
}
