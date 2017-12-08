$(document).ready(function() {
    window.APP = {};

    $.ajaxSetup({
        data: {
            csrf_token: config.token
        }
    });

    // Date time picker.
    $('.datetime-picker').each(function() {
        $(this).datetimepicker({
            format: 'YYYY/MM/DD ',
            minDate: getFormattedDate(new Date())

        });
    });

    function getFormattedDate(date) {
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear().toString().slice(2);
        return year + '-' + month + '-' + day;
    }

    // Color picker.
    if ($('#cp2').length > 0) {
        $('#cp2').colorpicker();
    }

    // Global ajax error handling
    $(document).ajaxError(function(event, jqxhr, settings, thrownError) {
        alert(jqxhr.statusText)
    });

    APP.initSelect2 = function() {
        if ($('.select2').length > 0) {
            $('.select2').select2();
        }
    }
    APP.initDatatable = function() {
        if ($('.datatable').length > 0) {
            $('.datatable').DataTable({
                responsive: true,
                lengthMenu: [25, 50, 75, 100],
                "bSort": false,
            });

            $('.datatable').on('page.dt', function() {
                $('.bootstrap-switch').bootstrapSwitch({
                    onSwitchChange: function(e, status) {
                        callbackUpdateDataStatus($(this).data('action'), $(this).data('id'), status);
                    }

                });
            });
        }
    }

    APP.closeModalWindow = function() {
        $('.modal').modal('hide');
    }

    APP.initTooltip = function() {
        $('[data-toggle="tooltip"]').tooltip();
    }

    APP.showFlashMessage = function(status, messsage) {
        var m = '<div class="alert alert-success" role="alert"><button class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button><strong>Well done!</strong> ' + messsage + '</div>';
        $('#flash-message-wrapper').html(m).show();
    }

    APP.bootstrapSwitch = function(className) {
        if ($(".bootstrap-switch").length > 0) {
            className = typeof className !== 'undefined' ? className : '.bootstrap-switch';
            $(className).bootstrapSwitch({
                onSwitchChange: function(e, status) {
                    callbackUpdateDataStatus($(this).data('action'), $(this).data('id'), status);
                }
            });
        }
    }

    // Initialization
    APP.initSelect2();
    APP.initDatatable();
    APP.initTooltip();
    APP.bootstrapSwitch();

    // Autoclose the flash message
    $("#flash-message-wrapper").delay(10000).slideUp(500, function() {
        $('#flash-message-wrapper').empty();
    });

    $(document).on('click', '.btn-loading', function() {
        var $btn = $(this);
        $btn.button('loading');
        setTimeout(function() {
            $btn.button('reset');
        }, 1000);
    })

    // Row deletion
    $(document).on('click', '.btn-delete', function(event) {
        event.preventDefault();
        var self = $(this);
        var url = config.admin_url + '/' + self.data('href')
        var url_segment = (self.data('href')).split('/');

        call_confirm_dialog(function(result) {
            if (!result) {
                return false;
            }
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                success: function(result) {
                    if (result.status) {
                        var row = self.closest('tr');
                        if (url_segment[2] == 'menu') {
                            window.location.reload();
                        } else {
                            $('.datatable').dataTable().fnDeleteRow(row);
                            APP.showFlashMessage(result.status, result.message);
                        }

                    }
                }
            })
        });
    })

    // Delete confirm dialog box
    function call_confirm_dialog(callback) {
        BootstrapDialog.show({
            title: 'Warning',
            message: 'Action is irreversible, do you want to proceed?',
            type: BootstrapDialog.TYPE_DANGER,
            size: BootstrapDialog.SIZE_SMALL,
            buttons: [{
                label: 'No',
                cssClass: 'btn-danger',
                action: function(dialog) {
                    dialog.close();
                    callback(0);
                }
            }, {
                label: 'Yes, Proceed',
                cssClass: 'btn-primary btn-loading',
                action: function(dialog) {
                    dialog.close();
                    callback(1);
                }
            }]
        });
    }

    // File Upload (New)
    if ($('#fileupload').length > 0) {
        $('#fileupload').fileupload({
            dataType: 'json',
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            formData: {
                csrf_token: config.token,
                folder: $('#fileupload').data('folder'),
                type: $('#type').val()
            },
            url: config.admin_url + '/upload',
            done: function(e, data) {
                $('#progress .bar').hide();
                $('.btn-submit').removeAttr('disabled');
                var result = data.result;
                $(this).closest('.upload-holder').find('#thumbnail-preview').attr('src', result.thumbnail);
                $(this).closest('.upload-holder').find('#image-id').val(result.name);
            },
            progress: function(e, data) {
                $('#progress .bar').show();
                var progress = parseInt((data.loaded / (data.total * 2)) * 100, 20);
                $('#progress .bar').css('width', progress + '%');
            },
            change: function(e, data) {
                $('.btn-submit').attr('disabled', 'disabled');
            }
        });
    }

    if ($('#fileupload_banner').length > 0) {
        $('#fileupload_banner').fileupload({
            dataType: 'json',
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            formData: {
                csrf_token: config.token,
                folder: $('#fileupload_banner').data('folder'),
                type: $('#banner-type').val()
            },
            url: config.admin_url + '/upload',
            done: function(e, data) {
                $('#progress .bar').hide();
                $('.btn-submit').removeAttr('disabled');
                var result = data.result;
                $(this).closest('.upload-holder').find('#thumbnail-banner-preview').attr('src', result.thumbnail);
                $(this).closest('.upload-holder').find('#image-banner-id').val(result.name);
            },
            progress: function(e, data) {
                $('#progress .bar').show();
                var progress = parseInt((data.loaded / (data.total * 2)) * 100, 20);
                $('#progress .bar').css('width', progress + '%');
            },
            change: function(e, data) {
                $('.btn-submit').attr('disabled', 'disabled');
            }
        });
    }

    if ($('#fileupload_icon').length > 0) {
        $('#fileupload_icon').fileupload({
            dataType: 'json',
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            formData: {
                csrf_token: config.token,
                folder: $('#fileupload_icon').data('folder'),
                type: $('#icon-type').val()
            },
            url: config.admin_url + '/upload',
            done: function(e, data) {
                $('#progress .bar').hide();
                $('.btn-submit').removeAttr('disabled');
                var result = data.result;
                $(this).closest('.upload-holder').find('#thumbnail-icon-preview').attr('src', result.thumbnail);
                $(this).closest('.upload-holder').find('#image-icon-id').val(result.name);
            },
            progress: function(e, data) {
                $('#progress .bar').show();
                var progress = parseInt((data.loaded / (data.total * 2)) * 100, 20);
                $('#progress .bar').css('width', progress + '%');
            },
            change: function(e, data) {
                $('.btn-submit').attr('disabled', 'disabled');
            }
        });
    }

    // Clock picker
    if ($('.clockpicker').length > 0) {
        $('.clockpicker').clockpicker({
            autoclose: true
        });
    }

    /*
     * http://stackoverflow.com/questions/12286332/twitter-bootstrap-remote-modal-shows-same-content-everytime
     * Solved the twitter bootstrap ajax modal problem
     */
    $('body').on('hidden.bs.modal', '.modal', function() {
        $(this).removeData('bs.modal');
    });

    // Called when modal loaded via ajax
    $('#modal-zipcode').on('shown.bs.modal', function() {
        APP.initSelect2();
    });
});

callbackUpdateDataStatus = function(action, id, status) {
    $.ajax({
        type: "POST",
        url: config.admin_url + action,
        data: {
            id: id,
            status: status
        },
        dataType: 'json',
        success: function(result) {
            APP.showFlashMessage(result.status, result.message);
        }
    })
}

if ($('.ckeditor').length > 0) {
    CKEDITOR.replace('editor', {
        filebrowserUploadUrl: config.admin_url + '/ck_uploader?folder=extras&csrf_token=' + config.token
    });
}


/*SETTING PERMISSION*/
$(document).on('change', '#group', function(event) {
    var group_id = $(this).val();
    if (!isNaN(group_id) && group_id != 0)
        window.location = config.admin_url + '/user/permissions/index/' + group_id;
})

if ($('#tree').length > 0) {
    $("#tree").dynatree({
        checkbox: true,
        selectMode: 3,
        onSelect: function(select, node) {
            var s = node.tree.getSelectedNodes().join(", ");
            var td = node.toDict();
            var selNodes = node.tree.getSelectedNodes();
            var data = [];
            var selKeys = $.map(selNodes, function(node1) {
                if (!node1.data.isFolder) {
                    data.push(node1.data.key);
                }

                $('#module_id').val(dict);
            });
            var s = node.tree.getSelectedNodes().join(" , ");
        },
    });
}

$(document).on('click', '#btn_submit_permission', function(event) {
    event.preventDefault();
    var dict = $("#tree").dynatree("getTree").toDict();
    var group_id = $('#group').val();
    $.ajax({
        url: config.admin_url + '/user/permissions/add_permission',
        type: 'POST',
        dataType: "json",
        data: {
            group: group_id,
            modules: dict
        },
        success: function(result) {
            if (result.STATUS == 1) {
                window.location.href = config.admin_url + '/user/permissions/index/' + group_id;
            }
        }
    });
});