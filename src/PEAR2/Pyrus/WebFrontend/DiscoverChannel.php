<?php
namespace PEAR2\Pyrus\WebFrontend;
class DiscoverChannel
{
    function __construct($options = array())
    {
        if (!empty($_POST)) {
            $this->handlePost();
        }
    }
    
    function handlePost()
    {
        if (isset($_POST['_type'], $_POST['channel'])) {
            $chan = 'https://' . $_POST['channel'] . '/channel.xml';
            try {
                $response = \PEAR2\Pyrus\Main::download($chan);
                if ($response->code != 200) {
                    throw new \PEAR2\Pyrus\Exception('Download of channel.xml failed');
                }
                $this->_addChannelXML($response->body);
            } catch (\Exception $e) {
                try {
                    $chan = 'http://' . $_POST['channel'] . '/channel.xml';
                    $response = \PEAR2\Pyrus\Main::download($chan);
                    if ($response->code != 200) {
                        throw new \PEAR2\Pyrus\Exception('Download of channel.xml failed');
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
        $chan = new \PEAR2\Pyrus\Channel(new \PEAR2\Pyrus\ChannelFile($xml, true));
        \PEAR2\Pyrus\Config::current()->channelregistry->add($chan);
    } 
}