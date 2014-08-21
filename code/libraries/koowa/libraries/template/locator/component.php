<?php
/**
 * Nooku Framework - http://nooku.org/framework
 *
 * @copyright   Copyright (C) 2007 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/nooku-framework for the canonical source repository
 */

/**
 * Component Template Locator
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Koowa\Library\Template\Locator
 */
class KTemplateLocatorComponent extends KTemplateLocatorIdentifier
{
    /**
     * The stream name
     *
     * @var string
     */
    protected static $_name = 'com';

    /**
     * Get the locator name
     *
     * @return string The stream name
     */
    public static function getName()
    {
        return self::$_name;
    }

    /**
     * Find a template path
     *
     * @param array  $info      The path information
     * @return bool|mixed
     */
    public function find(array $info)
    {
        $paths  = array();
        $loader = $this->getObject('manager')->getClassLoader();

        //Get the package
        $package = $info['package'];

        //Base paths
        if($path = $loader->getLocator('component')->getNamespace('\\')) {
            $paths[] = $path.'/'.$package;
        }

        $namespace = $this->getObject('object.bootstrapper')->getComponentNamespace($package);
        if($path = $loader->getLocator('component')->getNamespace($namespace)) {
            $paths[] = $path;
        }

        //File path
        $filepath = implode('/', $info['path']).'/templates/'.$info['file'].'.'.$info['format'].'.php';

        foreach($paths as $basepath)
        {
            if($result = $this->realPath($basepath.'/'.$filepath)) {
                return $result;
            }
        }

        return false;
    }
}