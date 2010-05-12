<?php
namespace PEAR2\Pyrus\WebFrontend;
class InstallPackage
{
    function __construct($options)
    {
        if (isset($_POST)) {
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
        $package = new \PEAR2\Pyrus\Package($name);
        try {
            \PEAR2\Pyrus\Installer::begin();
            \PEAR2\Pyrus\Installer::prepare($package);
            \PEAR2\Pyrus\Installer::commit();
        } catch (Exception $e) {
            \PEAR2\Pyrus\Installer::rollback();
            throw new \Exception('Unable to install '.$name, $e);
        }
    }
}