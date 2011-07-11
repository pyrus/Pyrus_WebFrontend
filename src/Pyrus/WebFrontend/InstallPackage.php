<?php
namespace Pyrus\WebFrontend;
class InstallPackage
{
    function __construct($options)
    {
        if (!empty($_POST)) {
            $this->handlePost();
        }
    }
    
    function handlePost()
    {
        if (isset($_POST['package'])) {
            $current_state = Controller::getConfig()->preferred_state;
            if (isset($_POST['stability'])) {
                Controller::getConfig()->preferred_state = $_POST['stability'];
            }
            $this->install($_POST['package']);
            Controller::getConfig()->preferred_state = $current_state;
        }
    }
    
    function install($name)
    {
        $package = new \Pyrus\Package($name);
        try {
            \Pyrus\Installer::begin();
            \Pyrus\Installer::prepare($package);
            \Pyrus\Installer::commit();
        } catch (Exception $e) {
            \Pyrus\Installer::rollback();
            throw new \Exception('Unable to install '.$name, $e);
        }
    }
}