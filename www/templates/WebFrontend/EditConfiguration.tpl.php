<h2>Edit Configuration</h2>
<form method="post" action="?view=config">
    <fieldset>
        <legend>System paths:</legend>
        <?php
        foreach ($context->mainsystemvars as $var) {
            echo "<label>$var:</label><input name=\"$var\" type=\"text\" value=\"{$context->$var}\" /><br />\n";
        }
        ?>
    </fieldset>
    <fieldset>
        <legend>Custom System paths:</legend>
        <?php
        foreach ($context->customsystemvars as $var) {
            echo "<label>$var:</label><input name=\"$var\" type=\"text\" value=\"{$context->$var}\" /><br />\n";
        }
        ?>
    </fieldset>
    <fieldset>
        <legend>User config (from <?php echo $context->userfile; ?>):</legend>
        <?php
        foreach ($context->mainuservars as $var) {
            echo "<label>$var:</label><input name=\"$var\" type=\"text\" value=\"{$context->$var}\" /><br />\n";
        }
        ?>
    </fieldset>
    <fieldset>
        <legend>(variables specific to <?php echo $context->default_channel; ?>):</legend>
        <?php
        foreach ($context->mainchannelvars as $var) {
            echo "<label>$var:</label><input name=\"$var\" type=\"text\" value=\"{$context->$var}\" /><br />\n";
        }
        ?>
    </fieldset>
    <fieldset>
        <legend>Custom User config (from <?php echo $context->userfile; ?>):</legend>
        <?php
        foreach ($context->customuservars as $var) {
            echo "<label>$var:</label><input name=\"$var\" type=\"text\" value=\"{$context->$var}\" /><br />\n";
        }
        ?>
    </fieldset>
    <fieldset>
        <legend>(variables specific to <?php echo $context->default_channel; ?>):</legend>
        <?php
        foreach ($context->customchannelvars as $var) {
            echo "<label>$var:</label><input name=\"$var\" type=\"text\" value=\"{$context->$var}\" /><br />\n";
        }
        ?>
    </fieldset>
</form>