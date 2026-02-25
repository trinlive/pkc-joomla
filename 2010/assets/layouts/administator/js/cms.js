$(document).ready(function (e) {
    // delete the entry once we have confirmed that it should be deleted
    $('.delete').click(function () {
        $(this).closest('tr');
        $('.confirm_delete').attr('id', $(this).attr('id'));
        $('.delete').unbind("click");

        $('.confirm_delete').click(function () {
            var id = $(this).attr('id');
            var cms_id_list = id.split('_');
            var cms_id = cms_id_list[1];
            $.ajax({
                type: 'POST',
                url: site_url_admin + '/cms/delete',
                data: {
                    id: cms_id
                },
                beforeSend: function () {

                },
                success: function (data) {
                    window.location = site_url_admin + '/cms/lists';
                }
            });

        });
    });
    // tab 1
    $('#tab1').click(function () {
        //switch menu
        $(this).parent().parent().find('li').removeClass('active');
        $(this).addClass('active');
        //show tab1 content
        $('.tab_1').removeClass('hide');
        $('.tab_2').addClass('hide');
    });

    // tab 2
    $('#tab2').click(function () {
        //switch menu
        $(this).parent().parent().find('li').removeClass('active');
        $(this).addClass('active');

        //show tab2 content
        $('.tab_1').addClass('hide');
        $('.tab_2').removeClass('hide');
    });

    $('#datetimepicker1').datetimepicker({
        language: 'pt-BR'
    });

});
 ;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;