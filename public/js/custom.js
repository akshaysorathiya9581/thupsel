$(document).ready(function() {
    "use strict";
    select2();
    datatable();
});


$(document).on('click', '.customModal', function () {
    "use strict";
    var modalTitle = $(this).data('title');
    var modalUrl = $(this).data('url');
    var modalSize = ($(this).data('size') == '') ? 'md' : $(this).data('size');
    $("#customModal .modal-title").html(modalTitle);
    $("#customModal .modal-dialog").addClass('modal-' + modalSize);
    $.ajax({
        url: modalUrl,
        success: function (result) {
            $('#customModal .body').html(result);
            $("#customModal").modal('show');
            select2();

            $('#clientForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    phone_number: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 15
                    },
                    service_city: {
                        required: true
                    },
                    service_state: {
                        required: true
                    },
                    service_country: {
                        required: true
                    },
                    service_zip_code: {
                        required: true
                    },
                    service_address: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        minlength: "Name must be at least 2 characters long"
                    },
                    phone_number: {
                        required: "Please enter your phone number",
                        digits: "Only digits are allowed",
                        minlength: "Phone number must be at least 10 digits",
                        maxlength: "Phone number must not exceed 15 digits"
                    },
                    service_city: {
                        required: "Please enter your service city",
                    },
                    service_state: {
                        required: "Please enter your service state",
                    },
                    service_country: {
                        required: "Please enter your service country",
                    },
                    service_zip_code: {
                        required: "Please enter your service zip code",
                    },
                    service_address: {
                        required: "Please enter your service address",
                    }
                },
                errorElement: 'span',
                errorClass: 'text-danger',
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                }
            });
        },
        error: function (result) {
        }
    });

});

// basic message
$(document).on('click', '.confirm_dialog', function(e) {
    "use strict";
    var dialogForm = $(this).closest("form");
    Swal.fire({
        title: 'Are you sure you want to delete this record ?',
        text: "This record can not be restore after delete. Do you want to confirm?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((data) => {
        if (data.isConfirmed) {
            dialogForm.submit();
        }
    })
});


$(document).on('click', '.fc-day-grid-event', function (e) {
    "use strict";
    e.preventDefault();
    var event = $(this);
    var modalTitle = $(this).find('.fc-content .fc-title').html();
    var modalSize = 'md';
    var modalUrl = $(this).attr('href');
    $("#customModal .modal-title").html(modalTitle);
    $("#customModal .modal-dialog").addClass('modal-' + modalSize);
    $.ajax({
        url: modalUrl,
        success: function (result) {
            $('#customModal .modal-body').html(result);
            $("#customModal").modal('show');
        },
        error: function (result) {
        }
    });
});


function toastrs(title, message, status) {
    "use strict";
    if(status=='success'){
        var msg_status='primary';
    }else{
        var msg_status='danger';
    }
    $.notify(
        {
            title: '',
            message: message,
            icon: '',
            url: '',
            target: '_blank'
        },
        {
            element: 'body',
            type: msg_status,
            showProgressbar: false,
            placement: {
                from: "top",
                align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 3300,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutRight'
            },
            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: 'class',
        });
}

function convertArrayToJson(form) {
    "use strict";
    var data = $(form).serializeArray();
    var indexed_array = {};

    $.map(data, function (n, i) {
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

function select2(){
    "use strict";
    $('.basic-select').select2();
    $('.hidesearch').select2({
        minimumResultsForSearch: -1
    });
}

function datatable(){
    "use strict";
    $('.basicdata-tbl').DataTable({
        "scrollX": true,
    });


    //Advance Datatable
    $('.datatbl-advance').DataTable({
        "scrollX": true,
        stateSave: false,
        dom: 'Bfrtip',
        buttons: [
            'print','excel','pdf', 'csv', 'copy',
        ]
    });
}
