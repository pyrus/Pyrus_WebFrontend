<?php
namespace pear2\Pyrus\WebFrontend;
class ClassToTemplateMapper extends \pear2\Templates\Savant\ClassToTemplateMapper
{
    function __construct($options = array())
    {
        static::$classname_replacement = 'pear2\Pyrus\\';
    }
    
    function map($class)
    {
        if (false === strpos($class, 'Exception')) {
            return parent::map($class);
        }
        
        return 'Exception.tpl.php';
    }
}