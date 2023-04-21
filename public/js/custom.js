function cdelete(title, id, token, route,next=[]) {

    swal({
        title: title,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: route,
                type: "POST",
                dataType: "JSON",
                data: {'id': id, _token: token},
                success: function (data) {
                    swal('success', data.success, 'success').then(function () {
                        if (next['type']=='d-t'){
                            InitTable();
                        }
                        else if (next['type']=='row-remove'){
                            next['target'].remove();
                        }
                        else if (next['type']=='fetch-file-manager'){
                            fetch(next['url']);
                        }
                        else if (next['type']=='reload'){
                            location.reload();
                        }else if (next['type']=='d-t-and-m-w-filter'){
                            $(modal).modal('hide');
                            InitTable(next['value']);
                        }else if (next['type']=='soft-dt'){
                            $("#example").DataTable().ajax.reload(null, false);
                        }

                    });
                },
                error: function (xhr) {
                    erroralert(xhr);
                },
            });

        }
    });
}
function erroralert(xhr) {

    if (typeof  xhr.responseJSON.errors === 'object') {
        var error = '';
        $.each(xhr.responseJSON.errors, function (key, item) {
            error += item;
        });
        swal("Failed", error, "error");
    } else {
        swal("Failed", xhr.responseJSON.message, "error");
    }
}

function InitTableS(r,c,t) {
    $('#example').DataTable({
        responsive: true,
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        "order": [[0, 'desc']],
        "pageLength": 25,
        "ajax": {
            "url": r,
            "dataType": "json",
            "type": "POST",
            "data": {_token: t}
        },
        "columns": c
    });
}
function cstore(t,r,n=[]) {
    var btn=$(t).attr('id');
    var button = $('.'+btn+'_btn');
    var modal = $('.'+btn+'_modal');
    var previous = $(button).html();
    button.attr('disabled', 'disabled').html('Processing <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
    $.ajax({
        url: r,
        type: "POST",
        data: new FormData(t),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            button.attr('disabled', null).html(previous);
            swal('success', data.success, 'success').then((value) => {
                if (n['type']=='route'){
                    window.location.href=n['url'];
                }
                if (n['type']=='reload'){
                    window.location.reload();
                }
                if (n['type']=='d-t-and-m'){
                    $(modal).modal('hide');
                    InitTable();
                }
                if (n['type']=='d-t-and-m-w-filter'){
                    $(modal).modal('hide');
                    InitTable(n['value']);
                }
                if (n['type']=='fetch-file-manager'){
                    fetch(n['url']);
                }
            });
        },
        error: function (xhr) {
            button.attr('disabled', null).html(previous);
            erroralert(xhr);
        }
    });
}