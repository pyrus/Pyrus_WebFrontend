<?php $parent->context->page_title = 'Edit Configuration'; ?>
<h2>Edit Configuration</h2>
<form method="post" action="?view=config">
    <input type="hidden" name="_type" value="config" />
    <?php
    $non_editable = array('php_dir', 'data_dir');
    $sections = array(
        'mainsystemvars'    => 'System Paths:',
        'customsystemvars'  => 'Custom System paths:',
        'mainuservars'      => 'User config (from '.$context->userfile.'):',
        'mainchannelvars'   => '(variables specific to '.$context->default_channel.'):',
        'customuservars'    => 'Custom User config (from '.$context->userfile.'):',
        'customchannelvars' => '(variables specific to '.$context->default_channel.'):'
        );
    foreach ($sections as $section=>$legend) :
    ?>
    <fieldset>
        <legend><?php echo $legend; ?></legend>
        <?php
        foreach ($context->$section as $var) {
            echo "<label>$var:</label>";
            if (!in_array($var, $non_editable)) {
                echo "<input name=\"config[$var]\" type=\"text\" value=\"{$context->$var}\" /><br />\n";
            } else {
                echo $context->$var.'<br />';
            }
        }
        ?>
    </fieldset>
    <?php endforeach; ?>

    <input type="submit" value="Submit" />
</form>