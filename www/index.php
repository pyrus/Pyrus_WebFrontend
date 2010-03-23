<?php
ini_set('display_errors', true);

require_once '/Users/bbieber/workspace/PEAR2/autoload.php';

function PEAR2_Pyrus_WebFrontend_autoload($class)
{
    $class = str_replace(array('_', '\\'), '/', $class);
    require_once $class . '.php';
}
spl_autoload_register("PEAR2_Pyrus_WebFrontend_autoload");

set_include_path(dirname(__DIR__).'/src');

pear2\Pyrus\WebFrontend\Controller::setConfigDir('/Users/bbieber/pyrus');
$controller = new pear2\Pyrus\WebFrontend\Controller($_GET);

pear2\Templates\Savant\ClassToTemplateMapper::$classname_replacement = 'pear2\Pyrus\\';

$savant = new pear2\Templates\Savant\Main();
$savant->setTemplatePath(__DIR__.'/templates');
$savant->setEscape('htmlspecialchars');
$savant->setFilters(array($controller, 'postRender'));

echo $savant->render($controller);