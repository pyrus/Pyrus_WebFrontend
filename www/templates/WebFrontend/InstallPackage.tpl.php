<?php
$parent->context->page_title = 'Install Package';
?>
<h2>Install Package</h2>
<form method="post" action="?view=install">
<input name="_type" value="install" type="hidden" />
<label>Package name (eg pear/Net_URL2):</label><input type="text" name="package" />
<select name="stability">
    <option value="<?php echo pear2\Pyrus\WebFrontend\Controller::getConfig()->preferred_state; ?>"><?php echo pear2\Pyrus\WebFrontend\Controller::getConfig()->preferred_state; ?> (preferred state)</option>
    <option value="alpha">alpha</option>
    <option value="beta">beta</option>
    <option value="stable">stable</option>
</select>
<input type="submit" value="Submit" />
</form>