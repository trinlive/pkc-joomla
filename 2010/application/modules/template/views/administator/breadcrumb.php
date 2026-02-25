<!-- start: PAGE HEADER -->
<div class="row">
    <div class="col-sm-12">
        <!-- start: PAGE TITLE & BREADCRUMB -->
        <?php echo set_breadcrumb(' / ',array('administator'),$breadcrumb);?>
        <div class="page-header">
            <h1><?php echo ucfirst($this->uri->segment(2)); ?>  <?php echo ucfirst($this->uri->segment(3)); ?></h1>
        </div>
        <!-- end: PAGE TITLE & BREADCRUMB -->
    </div>
</div>
<!-- end: PAGE HEADER -->