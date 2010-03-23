<?php
namespace pear2\Pyrus\WebFrontend;
class DiscoverChannel
{
    function __construct($options = array())
    {
        if (isset($_POST)) {
            $this->handlePost();
        }
    }
    
    function handlePost()
    {
        if (isset($_POST['_type'], $_POST['channel'])) {
            $chan = 'https://' . $_POST['channel'] . '/channel.xml';
            try {
                $response = \pear2\Pyrus\Main::download($chan);
                if ($response->code != 200) {
                    throw new \pear2\Pyrus\Exception('Download of channel.xml failed');
                }
                $this->_addChannelXML($response->body);
            } catch (\Exception $e) {
                try {
                    $chan = 'http://' . $_POST['channel'] . '/channel.xml';
                    $response = \pear2\Pyrus\Main::download($chan);
                    if ($response->code != 200) {
                        throw new \pear2\Pyrus\Exception('Download of channel.xml failed');
                    }
                    $this->_addChannelXML($response->body);
                } catch (\Exception $e) {
                    // failed, re-throw original error
                    throw new \Exception('Could not discover the channel '.$_POST['channel'], $e);
                }
            }
        }
    }
    
    protected function _addChannelXML($xml)
    {
        $chan = new \pear2\Pyrus\Channel(new \pear2\Pyrus\ChannelFile($xml, true));
        \pear2\Pyrus\Config::current()->channelregistry->add($chan);
    } 
}