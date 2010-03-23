<?php
namespace pear2\Pyrus\WebFrontend;
class EditConfiguration
{
    protected $config;
    
    function __construct($options = array())
    {
        if (isset($_POST)) {
            $this->handlePost();
        }
        $this->config = Controller::getConfig();
    }
    
    function handlePost()
    {
        if (isset($_POST['_type'], $_POST['config'])
            && is_array($_POST['config'])) {
            // OK
        }
    }
    
    function __get($var)
    {
        return $this->config->$var;
    }
}