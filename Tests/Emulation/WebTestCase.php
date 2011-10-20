<?php

namespace Ivory\GoogleMapBundle\Tests\Emulation;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Ivory\GoogleMapBundle\Tests\Util;

/**
 * Web test case
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class WebTestCase extends BaseWebTestCase
{
    /**
     * @var boolean TRUE if the web test case has been initialized else FALSE
     */
    protected static $initialize = false;
    
    /**
     * Remove emulation cache & logs directories
     */
    protected static function initialize($environment)
    {
        if(!self::$initialize)
        {
            if(file_exists(__DIR__.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.$environment))
                Util::removeDirectoryRecursilvy(__DIR__.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR.$environment);
            
            if(file_exists(__DIR__.DIRECTORY_SEPARATOR.'logs'))
                Util::removeDirectoryRecursilvy(__DIR__.DIRECTORY_SEPARATOR.'logs');
            
            self::$initialize = true;
        }
    }
    
    /**
     *@override
     */
    protected static function getKernelClass()
    {
        $kernelClass = 'AppKernel';
        
        require_once __DIR__.DIRECTORY_SEPARATOR.$kernelClass.'.php';

        return $kernelClass;
    }
    
    /**
     * Gets the kernel container
     *
     * @return Symfony\Component\DependencyInjection\ContainerInterface
     */
    public static function createContainer(array $options = array('environment' => 'default'))
    {
        self::initialize($options['environment']);
        
        $kernel = self::createKernel($options);
        $kernel->boot();

        return $kernel->getContainer();
    }
}
