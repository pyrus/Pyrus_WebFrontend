<?php
/**
 * Pyrus\WebFrontend\Controller
 *
 * PHP version 5
 *
 * @category  Yourcategory
 * @package   Pyrus_WebFrontend
 * @author    Your Name <handle@php.net>
 * @copyright 2010 Your Name
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   SVN: $Id$
 * @link      https://github.com/pyrus/Pyrus_WebFrontend
 */

/**
 * Controller class for Pyrus_WebFrontend
 *
 * @category  Yourcategory
 * @package   Pyrus_WebFrontend
 * @author    Your Name <handle@php.net>
 * @copyright 2010 Your Name
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @link      https://github.com/pyrus/Pyrus_WebFrontend
 */
namespace Pyrus\WebFrontend;
class Controller
{
    public $view_map = array(
        'index'         => 'Pyrus\WebFrontend\Index',
        'config'         => 'Pyrus\WebFrontend\EditConfiguration',
        'discoverchannel' => 'Pyrus\WebFrontend\DiscoverChannel',
        'list_channels' => 'Pyrus\WebFrontend\ListChannels',
        'list_packages' => 'Pyrus\WebFrontend\ListPackages',
        'install'       => 'Pyrus\WebFrontend\InstallPackage'
    );
    
    public $options = array('view'=>'index');
    
    public $page_title = '{page_title}';
    
    protected static $config;
    
    public $actionable = array();
    
    function __construct($options = array())
    {
        $this->options = $options + $this->options;

        if (!empty($_POST)) {
            try {
                $this->handlePost();
            } catch(\Exception $e) {
                $this->actionable[] = $e;
            }
        }

        try {
            $this->run();
        } catch(\Exception $e) {
            $this->actionable[] = $e;
        }
    }
    
    function handlePost()
    {
        switch($_POST['_type']) {
            case '':
                break;
        }
    }
    
    static function setConfigDir($dir)
    {
        self::$config = \Pyrus\Config::singleton($dir);
    }
    
    static function getConfig()
    {
        if (!isset(self::$config)) {
            return \Pyrus\Config::current();
        }
        return self::$config;
    }
    
    function run()
    {
         if (isset($this->view_map[$this->options['view']])) {
             $this->actionable[] = new $this->view_map[$this->options['view']]($this->options);
         } else {
             throw new UnregisteredViewException('Un-registered view');
         }
    }
    
    /**
     * Register a new view for the frontend.
     * 
     * @param string $route The route used to identify this model and view
     * @param string $class Class to instantiate when this view is requested.
     * 
     * @return Controller
     */
    function registerView($route, $classname)
    {
        static::$view_map[$route] = $classname;
        return $this;
    }
    
    /**
     * Get the URL to a specific view
     * 
     * @param mixed $class What class to return a route for
     * 
     * @return string The url
     */
    public static function getURL($class = null)
    {
        static $default_view;
        
        if (empty($default_view)) {
            $main = new \ReflectionClass(__CLASS__);
            $properties = $main->getDefaultProperties();
            $default_view = $properties['options']['view'];
        }
        
        $url = static::$url;
        if ($class) {
            if (is_object($class)) {
                $class = get_class($class);
            }
            $route = array_keys(static::$view_map, $class);
            if (!count($route)) {
                throw new UnregisteredViewException('The view for that object is not registered');
            }

            if ($route[0] != $default_view) {
                $url .= '?view=' . $route[0];
            }

        }
        return $url;
    }
    
    /**
     * Called after the page is rendered to perform any necessary replacements.
     *
     * @param string $html The rendered template.
     *
     * @return string Filtered html
     */
    public function postRender($html)
    {
        $html = str_replace('{page_title}',
                            $this->page_title,
                            $html);
        return $html;
    }
}
