<?php
echo '<ul><li>'.$context->getMessage();
foreach ($context as $error) {
    echo $savant->render($error, 'ExceptionMessage.tpl.php');
}
if ($context = $context->getPrevious()) {
    echo $savant->render($context, 'ExceptionMessage.tpl.php');
}
echo '</li>';
echo '</ul>';