var response;
function submit(b,m,r,d,n) {
    var previous= b.text();
    b.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing ...');

    $.ajax({
        type:m,
        url:r,
        data: d,
        dataType:'JSON',
        processData: false,
        contentType: false,
        cache: false,
        success:function(data) {
            b.attr('disabled',null).html(previous);
            if (n['type']=='form-reset'){
                n['target'].trigger("reset");
            }
            swal("Success!", data.success, "success").then(function () {
                if (n['type']=='data-table-modal'){
                    $('#modal').modal('hide');
                    $('#example').DataTable().ajax.reload();
                }
                if (n['type']=='next-route'){
                    window.location.href=n['url'];
                }
                if (n['type']=='reload'){
                    window.location.reload();
                }
            });
        },
        error:function (xhr) {
            b.attr('disabled',null).html(previous);
            erroralert(xhr);
        }
    });
}
function InitTable(r,t,col) {
    $('#example').DataTable({
        responsive: false,
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        "order": [[0, 'asc']],
        "pageLength": 25,
        "ajax": {
            "url": r,
            "dataType": "json",
            "type": "POST",
            "data": {_token: t}
        },
        "columns":col
    });
}

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
            error += item+'\n';
            if ($(document).find('[name="'+key+'"]').length>0){
                var element=$(document).find('[name="'+key+'"]');
                if(element.hasClass('form-control')){
                    element.addClass('is-invalid').after('<span class="invalid-feedback is-invalid">'+item+'</span>');
                }else{
                    $.toast({
                        heading: 'Failed',
                        text: item,
                        icon: 'error',
                        position: 'top-right',
                    });
                }
            } else{
                $.toast({
                    heading: 'Failed',
                    text: item,
                    icon: 'error',
                    position: 'top-right',
                });
            }
        });
        //swal("Failed", error, "error");
    } else {
        $.toast({
            heading: 'Failed',
            text: xhr.responseJSON.message,
            icon: 'error',
            position: 'top-right',
        });
    }
}