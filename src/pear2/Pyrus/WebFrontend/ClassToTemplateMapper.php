<?php
namespace PEAR2\Pyrus\WebFrontend;
class ClassToTemplateMapper extends \PEAR2\Templates\Savant\ClassToTemplateMapper
{
    function __construct($options = array())
    {
        static::$classname_replacement = 'PEAR2\Pyrus\\';
    }
    
    function map($class)
    {
        if (false === strpos($class, 'Exception')) {
            return parent::map($class);
        }
        
        return 'Exception.tpl.php';
    }
}