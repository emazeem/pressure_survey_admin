function fetchNetworkOnProfile(user_id, type, route, token, nextURL) {
    $.ajax({
        type: "POST",
        url: route,
        data: {'type': type, _token: token, 'user_id': user_id},
        beforeSend: function () {
            $('.friend-grid-inner').html('<div class="col-md-12 text-center"><h1><i class="spinner-border spinner-border-large"></i></h1></div>');
        },
        success: function (data) {
            $('.friend-grid-inner').html(data);
            $('.see-all-url').html('<a href="' + nextURL + '">See All</a>');
        },
        error: function (xhr) {
            erroralert(xhr);
        }
    })
}

function updateProfilePicture(form, route) {


    var showPostDiv = $('.load-posts');
    $.ajax({
        url: route,
        data: form,
        dataType: "JSON",
        type: "post",
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $('.profile_photo_preview').attr('src', data.response);
            $('#profile_photo_input').val('');
            $.toast({
                heading: 'Success',
                text: data.success,
                icon: 'success',
                position: 'top-right',
            });
            if (window.location.href == window.location.origin + '/ambassador') {
                showPostDiv.prepend(data.html);
                getGalleryImages();
            }


            var url = window.location.href.split('/');
            var type = url[url.length - 1];
            if (url.join('/', url.pop(url.length - 1)) == window.location.origin + '/gallery') {
                fetch(type);
            }

        },
        error: function (xhr) {
            erroralert(xhr);
        },
    });
}

function updateCoverPhoto(form, route) {
    $('.cover-edit').append('<span >Uploading...</span>');
    $('#cover_photo_preview').addClass('animate-pulse');
    var showPostDiv = $('.load-posts');

    $.ajax({
        url: route,
        data: form,
        dataType: "JSON",
        type: "post",
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $('.cover-edit').html('<span class="icon edit-cover"><span class="ti-camera "></span></span>');
            $('#cover_photo_preview').removeClass('animate-pulse');
            $('#cover_photo_preview').attr('src', data.response);
            $('#cover_photo_input').val('');
            $.toast({
                heading: 'Success',
                text: data.success,
                icon: 'success',
                position: 'top-right',
            });
            if (window.location.href == window.location.origin + '/ambassador') {
                showPostDiv.prepend(data.html);
                getGalleryImages();
            }
            var url = window.location.href.split('/');
            var type = url[url.length - 1];
            if (url.join('/', url.pop(url.length - 1)) == window.location.origin + '/gallery') {
                fetch(type);
            }
        },
        error: function (xhr) {
            $('.cover-edit').html('<span class="icon edit-cover"><span class="ti-camera "></span></span>');
            $('#cover_photo_preview').removeClass('animate-pulse');
            erroralert(xhr);
        },
    });
}

function changeFullName(form, route) {
    $.ajax({
        type: "POST",
        url: route,
        data: form,
        dataType: 'JSON',
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $('#update-name-modal').modal('hide');
            $('.full-name-of-current-user').html(data.response.fname + ' ' + data.response.lname);
        },
        error: function (xhr) {
            erroralert(xhr);
        }
    });
}

function cardType(number) {

    //Visa
    var re = new RegExp("^4");
    if (number.match(re) != null)
        return "visa";
    // Mastercard
    if (/^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/.test(number))
        return "Mastercard";
    // AMEX
    /*re = new RegExp("^3[47]");
    if (number.match(re) != null)
        return "amex";
    */
    // AMEX
    re = new RegExp(/^(?:3[47][0-9]{13})$/);
    if (number.match(re) != null)
        return "amex";


    // Union pay
    re = new RegExp("^(62[0-9]{14,17})$");
    if (number.match(re) != null)
        return "unionpay";

    return false;
}

function errorsOfValidationOfCards(xhr) {
    if (typeof  xhr.responseJSON.errors === 'object') {
        var error = '';
        $.each(xhr.responseJSON.errors, function (key, item) {
            if (item == 'validation.credit_card.card_expiration_year_invalid') {
                error += 'Card expiration year is invalid. \n';
            } else if (item == 'validation.credit_card.card_expiration_month_invalid') {
                error += 'Card expiration month is invalid. \n';
            }
            else if (
                item == 'validation.credit_card.card_invalid' ||
                item == 'validation.credit_card.card_cvc_invalid' ||
                item == 'validation.credit_card.card_checksum_invalid'
            ) {
                error += 'Card number is invalid. \n';
            }
            else {
                error += item + '\n';
            }

        });
        swal("Failed", error, "error");
    } else {
        swal("Failed", xhr.responseJSON.message, "error");
    }
}

function markBankCardAsPreferred(id, token) {
    $.ajax({
        type: "post",
        url: '/wallet/payment-method/preferred',
        data: {_token: token, "id": id},
        dataType: "json",
        success: function (data) {
            $('#pay-now-btn').removeAttr('disabled');
            fetchCards();
        }
    })
}

function showPostPopup(url, token, id) {
    $('body').addClass('show-post');
    $.ajax({
        url: url,
        data: {'id': id, _token: token}, 
        dataType: "JSON",
        type: "POST",
        success: function (data) {
            $('.single-post-pop-up').html(data).show(500);
        },
        error: function (xhr) {
            erroralert(xhr);
        },
    });
}

function updatePost(_this, route, form) {
    var targetToRemove = _this.closest('.content-card');

    var privacy = _this.find('.set-privacy-dropdown-value').attr('data-value');
    $('#edit_post_privacy').val(privacy);

    var button = _this.find('button[type=submit]');
    var previous = button.text();
    button.attr('disabled', 'disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing ...');

    $.ajax({
        type: "POST",
        url: route,
        data: form,
        dataType: 'JSON',
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            button.attr('disabled', null).html(previous);
            targetToRemove.html(data.html);
        },
        error: function (xhr) {
            button.attr('disabled', null).html(previous);
            erroralert(xhr);
        }
    });
}

function deletePost(_this, token, route) {
    var targetToRemove = _this.closest('.content-card');
    swal({
        title: "Are you sure to remove this post?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((confirm) => {
        if (confirm) {
            var id = _this.attr('data-id');
            $.ajax({
                url: route,
                data: {'id': id, _token: token},
                dataType: "JSON",
                type: "delete",
                success: function (data) {
                    targetToRemove.remove();
                },
                error: function (xhr) {
                    erroralert(xhr);
                },
            });
        }
    });
}

function deleteAssetOfPost(_this, token, route) {
    swal({
        title: "Are you sure to remove?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((confirm) => {
        if (confirm) {
            var id = _this.attr('data-id');
            var post = _this.attr('data-post');

            var toEnableModal = $('.edit-post-attachment-enabler-' + post);
            $.ajax({
                url: route,
                data: {'id': id, _token: token},
                dataType: "JSON",
                type: "delete",
                success: function (data) {
                    $('.post-edit-photo-main-' + post).remove();
                    toEnableModal.addClass('edit-post-modal-show');
                },
                error: function (xhr) {
                    erroralert(xhr);
                },
            });
        }
    });
}

function showModalToUploadFileOnPostStore(_this) {
    var type = _this.attr('data-type');
    var id = _this.attr('data-post');
    if (type == 'link') {
        $('.url-div').show();
        $('.file-div').hide();
    } else {
        $('.url-div').hide();
        $('.file-div').show();
    }
    $('#file_type_popup' + id).val(type);
    $('#file_type' + id).val(type);
    $('#edit-post-upload-file-modal-' + id).attr('data-post', _this.attr('data-post')).modal('show');
}

function blockUser(to,route,token) {

    $.ajax({
        url: route,
        data: {'to': to, _token: token},
        dataType: "JSON",
        type: "post",
        success: function (data) {
            $.toast({
                heading: 'Success',
                text: data.success,
                icon: 'success',
                position: 'top-right',
                hideAfter: 2000,
                afterHidden: function () {
                    window.location.reload();
                }
            });
        },
        error: function (xhr) {
            erroralert(xhr);
        },
    });
}
function unblockUser(_this,route,token) {
    var to=_this.attr('data-to');
    var from=_this.attr('data-from');
    $.ajax({
        url: route,
        data: {'from': from,'to': to, _token: token},
        dataType: "JSON",
        type: "post",
        success: function (data) {
            $.toast({
                heading: 'Success',
                text: data.success,
                icon: 'success',
                position: 'top-right',
                hideAfter: 2000,
            });
            _this.closest('.blocked-users-row').remove();
            if ($('.blocked-users-grid').children().length ==0){
                $('.blocked-users-grid').html($('.empty-block-list-html').html());
            }
        },
        error: function (xhr) {
            erroralert(xhr);
        },
    });
}
function dismissToast(){
    $.toast().reset('all');
}
$(document).on('click','.dismiss-toast',function (e) {
    dismissToast();
});
