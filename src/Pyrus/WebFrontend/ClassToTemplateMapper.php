<?php
namespace Pyrus\WebFrontend;
class ClassToTemplateMapper extends \PEAR2\Templates\Savant\ClassToTemplateMapper
{
    function __construct($options = array())
    {
        static::$classname_replacement = 'Pyrus\\';
    }

    function map($class)
    {
        if (false === strpos($class, 'Exception')) {
            return parent::map($class);
        }

        return 'Exception.tpl.php';
    }
}