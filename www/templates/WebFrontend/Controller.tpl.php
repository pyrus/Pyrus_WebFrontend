<!DOCTYPE html>
<head>
    <title><?php echo $context->page_title; ?></title>
</head>
<body>
    <ul>
        <li><a href="?view=index">Home</a></li>
        <li><a href="?view=list_packages">List Packages</a></li>
        <li><a href="?view=list_channels">List Channels</a></li>
        <li><a href="?view=install">Install/Upgrade</a></li>
        <li><a href="?view=discoverchannel">Add Channel</a></li>
        <li><a href="?view=config">Edit Configuration</a></li>
    </ul>
    <?php echo $savant->render($context->actionable); ?>
</body>