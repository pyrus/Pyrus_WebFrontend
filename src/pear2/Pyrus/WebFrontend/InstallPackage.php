<?php
namespace pear2\Pyrus\WebFrontend;
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
        $package = new \pear2\Pyrus\Package($name);
        try {
            \pear2\Pyrus\Installer::begin();
            \pear2\Pyrus\Installer::prepare($package);
            \pear2\Pyrus\Installer::commit();
        } catch (Exception $e) {
            \pear2\Pyrus\Installer::rollback();
            throw new \Exception('Unable to install '.$name, $e);
        }
    }
}