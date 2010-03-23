<?php
$parent->context->page_title = 'Installed Packages';
foreach ($context as $channel=>$packages)
{
    echo '<h2>'.$channel.'</h2>';
    echo '<ul>';
    foreach ($packages as $package) {
        echo '<li>'.$package.'</li>';
    }
    echo '</ul>';
}