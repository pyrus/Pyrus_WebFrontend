#!/usr/bin/env php
<?php
/**
 * If your package does special stuff in phar format, use this file.  Remove if
 * no phar format is ever generated
 */
if (version_compare(phpversion(), '5.3.1', '<')) {
    if (substr(phpversion(), 0, 5) != '5.3.1') {
        // this small hack is because of running RCs of 5.3.1
        echo "Pyrus_WebFrontend requires PHP 5.3.1 or newer.
";
        exit -1;
    }
}
foreach (array('phar', 'spl', 'pcre', 'simplexml') as $ext) {
    if (!extension_loaded($ext)) {
        echo 'Extension ', $ext, " is required
";
        exit -1;
    }
}
try {
    Phar::mapPhar();
} catch (Exception $e) {
    echo "Cannot process Pyrus_WebFrontend phar:
";
    echo $e->getMessage(), "
";
    exit -1;
}
function Pyrus_WebFrontend_autoload($class)
{
    $class = str_replace('_', '\\', $class);
    if (file_exists('phar://' . __FILE__ . '/Pyrus_WebFrontend-@PACKAGE_VERSION@/php/' . implode('/', explode('\\', $class)) . '.php')) {
        include 'phar://' . __FILE__ . '/Pyrus_WebFrontend-@PACKAGE_VERSION@/php/' . implode('/', explode('\\', $class)) . '.php';
    }
}
spl_autoload_register("Pyrus_WebFrontend_autoload");
$phar = new Phar(__FILE__);
$sig = $phar->getSignature();
define('Pyrus_WebFrontend_SIG', $sig['hash']);
define('Pyrus_WebFrontend_SIGTYPE', $sig['hash_type']);

// your package-specific stuff here, for instance, here is what Pyrus does:

/**
 * $frontend = new \Pyrus\ScriptFrontend\Commands;
 * @array_shift($_SERVER['argv']);
 * $frontend->run($_SERVER['argv']);
 */
__HALT_COMPILER();
