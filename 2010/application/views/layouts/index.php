<?php echo $this->head->render_doctype()?>
<?php echo $this->head->render_html() ?>
<head>
<?php echo $this->head->render_meta() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php echo $this->head->render_base() ?>
<?php echo $this->head->render_misc() ?>
<?php echo $this->head->render_favicon() ?>
<?php echo $this->head->render_title() ?>
<?php echo $this->template->display('css_core') ?>
<?php echo $this->template->display('js_core') ?>
<?php echo $_scripts;?>
<?php echo $_styles;?>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]>
    <script src="<?php echo site_assets_url('layouts/frontend/js/ie8-responsive-file-warning.js');?>"></script>
    <![endif]-->
    <script src="<?php echo site_assets_url('layouts/frontend/js/ie-emulation-modes-warning.js');?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body<?php echo $this->head->render_body() ?>>
<?php echo $template ?>
<!-- [S] CSS VIEW -->
<?php echo $this->template->display('css') ?>
<!-- [E] CSS VIEW -->
<!-- [S] JS VIEW -->
<?php echo $this->template->display('js') ?>
<!-- [E] JS VIEW -->
</body>
</html>