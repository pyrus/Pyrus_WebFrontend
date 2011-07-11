<?php
namespace Pyrus\WebFrontend;
class ListChannels extends \ArrayIterator
{
    function __construct($options = array())
    {
        $channel_registry = Controller::getConfig()->channelregistry;
        $channels = array();
        foreach ($channel_registry as $channel) {
            $channels[$channel->name] = $channel->alias;
        }
        ksort($channels);
        parent::__construct($channels);
    }
}