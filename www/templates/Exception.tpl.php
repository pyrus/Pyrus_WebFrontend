<?php $parent->context->page_title = 'Error'; ?>
<h2>Eh, sorry - that didn't work.</h2>
<?php echo $savant->render($context, 'ExceptionMessage.tpl.php'); ?>