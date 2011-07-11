<?php
namespace Pyrus\WebFrontend;
class EditConfiguration
{
    protected $config;
    
    function __construct($options = array())
    {
        $this->config = Controller::getConfig();
        if (!empty($_POST)) {
            $this->handlePost();
        }
    }
    
    function handlePost()
    {
        if (isset($_POST['_type'], $_POST['config'])
            && is_array($_POST['config'])) {
            // OK
            foreach ($_POST['config'] as $var=>$value) {
                if (in_array($var, $this->config->uservars)
                    || in_array($var, $this->config->systemvars)) {
                    $this->config->$var = $value;
                }
                $this->config->$var = $value;
            }
            $this->config->saveConfig();
        }
    }
    
    function __get($var)
    {
        return $this->config->$var;
    }
}