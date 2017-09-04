/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {
    jQuery(document).ready(function (re) {

        jQuery('[data-toggle="tooltip"]').tooltip();

        //Toaster Notification Library
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "100",
            "hideDuration": "500",
            "timeOut": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }


        //Top progressbar
        NProgress.configure({showSpinner: true});
        NProgress.start();
        NProgress.done();

        //DataTables 
        window.adminlistingTable = jQuery('.adminlisting').DataTable({
            "aoColumns": [
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": false},
            ]
        });

        window.adminrolelistingTable = jQuery('.adminrolelisting').DataTable({
            "aoColumns": [
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": false},
            ]
        });

        //Upload file media
        jQuery(document).on('click', '.browse', function () {
            var file = $(this).parent().parent().parent().find('.file');
            file.trigger('click');
        });
        jQuery(document).on('change', '.file', function () {
            $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
        });

        //Delete Media
        jQuery('.delete_media').click(function (e) {
            e.preventDefault();
            var deleteId = jQuery(this).attr('data-id');
            if (deleteId) {
                jQuery.ajax({
                    url: '/dashboard/media/' + deleteId,
                    type: 'POST',
                    data: {_method: 'DELETE', _token: jQuery('meta[name="csrf-token"]').attr('content'), id: deleteId},
                    dataType: 'json',
                    success: function (r) {
                        toastr.info(r.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 500);
                    },
                    error: function (jqXHR, textMessage) {
                        console.log(textMessage);
                    }
                });
            }
        });

        //Delete a Task
        jQuery('.delete_post').click(function (e) {
            e.preventDefault();
            var deleteId = jQuery(this).attr('data-id');
            if (deleteId) {
                jQuery.ajax({
                    url: '/dashboard/posts/' + deleteId,
                    type: 'POST',
                    data: {_method: 'DELETE', _token: jQuery('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    success: function (r) {
                        toastr.info(r.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 500);
                    },
                    error: function (jqXHR, textMessage) {
                        console.log(textMessage);
                    }
                });
            }
        });

        //Delete a Role
        jQuery('.delete_role').click(function (e) {
            e.preventDefault();
            var deleteId = jQuery(this).attr('data-id');
            if (deleteId) {
                jQuery.ajax({
                    url: '/dashboard/roles/' + deleteId,
                    type: 'POST',
                    data: {_method: 'DELETE', _token: jQuery('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    success: function (r) {
                        toastr.info(r.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 500);
                    },
                    error: function (jqXHR, textMessage) {
                        console.log(textMessage);
                    }
                });
            }
        });


        //Delete user
        jQuery('.delete_user').click(function (e) {
            e.preventDefault();
            var deleteId = jQuery(this).attr('data-id');
            if (deleteId) {
                jQuery.ajax({
                    url: '/dashboard/users/' + deleteId,
                    type: 'POST',
                    data: {_method: 'DELETE', _token: jQuery('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    success: function (r) {
                        toastr.info(r.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 500);
                    },
                    error: function (jqXHR, textMessage) {
                        console.log(textMessage);
                    }
                });
            }
        });

        //Tinymce
        tinymce.init({
            branding: false,
            selector: 'textarea',
            height: 250,
            menubar: false,
            plugins: [
                'autolink lists link print preview textcolor',
                'searchreplace visualblocks code fullscreen',
                'table paste code'
            ],
            toolbar: 'undo redo |  styleselect | bold italic link | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat | preview',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css']
        });

    });
}(jQuery));


