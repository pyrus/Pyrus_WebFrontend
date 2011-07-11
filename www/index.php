<?php
ini_set('display_errors', true);

require_once dirname(__DIR__).'/../../autoload.php';

function Pyrus_WebFrontend_autoload($class)
{
    $class = str_replace(array('_', '\\'), '/', $class);
    require_once $class . '.php';
}
spl_autoload_register("Pyrus_WebFrontend_autoload");

set_include_path(dirname(__DIR__).'/src');

Pyrus\WebFrontend\Controller::setConfigDir('/tmp/pyrustest');
$controller = new Pyrus\WebFrontend\Controller($_GET);


$savant = new PEAR2\Templates\Savant\Main();
$savant->setClassToTemplateMapper(new Pyrus\WebFrontend\ClassToTemplateMapper);
$savant->setTemplatePath(__DIR__.'/templates');
$savant->setEscape('htmlspecialchars');
$savant->setFilters(array($controller, 'postRender'));

echo $savant->render($controller);