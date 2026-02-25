<?php echo $header; ?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <div class="navbar-content">
        <?php echo $sidebar; ?>
    </div>
    <!-- start: PAGE -->
    <div class="main-content">
        <!-- start: DELETE CONFIRM MODAL FORM -->
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">ยืนยัน ลบ</h4>
            </div>
            <div class="modal-body">
                คุณต้องการลบ ใช่หรือไม่ ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    ปิด
                </button>
                <button type="button" class="btn btn-primary confirm_delete">
                    ลบ
                </button>
            </div>
        </div>
        <!-- end: DELETE MODAL FORM -->
        <div class="container">
            <?php echo $breadcrumb; ?>
            <?php echo $content; ?>
        </div>
    </div>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
<script>
    jQuery(document).ready(function() {
        Main.init();
        FormElements.init();
    });
</script>