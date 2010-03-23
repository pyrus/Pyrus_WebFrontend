<?php $parent->context->page_title = 'Channels'; ?>
<h2>Channels</h2>
<ul>
<?php
foreach($context as $channel => $alias) {
    echo '<li>'.$channel . ' (' . $alias . ")</li>\n";
}?>
</ul>
