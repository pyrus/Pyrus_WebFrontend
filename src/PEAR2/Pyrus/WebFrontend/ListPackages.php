<?php
namespace PEAR2\Pyrus\WebFrontend;
class ListPackages extends \ArrayIterator
{
    function __construct($options = array())
    {
        $packages         = array();
        $registry         = Controller::getConfig()->registry;
        $channel_registry = Controller::getConfig()->channelregistry;

        foreach ($channel_registry as $channel) {
            Controller::getConfig()->default_channel = $channel->name;
            foreach ($registry->package as $package) {
                $packages[$channel->name][] = $package->name;
            }
        }
        asort($packages);
        parent::__construct($packages);
    }
}