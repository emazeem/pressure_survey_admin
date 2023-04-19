<div class="modal fade" id="2fa-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="2fa-form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bx bx-lock"></i> Two Factor Authentication Required</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="min-height: 200px">
                    <div class="send-mail-div">
                        Two factor authentication is required for this action. Click on button below to send 6-Digits on your email ({{auth()->user()->email}}).
                        <a class="text-decoration-underline" href="javascript:void(0)" id="send-code">Send 6-Digit Code</a>
                    </div>
                    <div class="verify-code-div" style="display: none;">
                        <div class="col-md-12">
                            <label for="code">Please enter the 6-Digit Code sent to your email.</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value=""
                                       placeholder='XXXXXX' maxlength="6" name="code" required id="code">
                                <div class="input-group-prepend">
                                    <button class="input-group-text btn border" id="check-code">Submit</button>
                                </div>
                            </div>
                            <a class="text-decoration-underline" href="javascript:void(0)" id="re-send-code">Resend 6-Digit Code</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push("script")
<script>
    $(function () {
        $(document).on('click','#send-code',function (e) {
            e.preventDefault();
            $('#2fa-modal').modal('show');
            var previous= $(this).text(),b=$(this);
            b.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing ...');

            $.ajax({
                url: '{{route('two.factor.send.code')}}',
                type: "POST",
                dataType: "JSON",
                data: {_token:'{{csrf_token()}}'},
                success: function (data) {
                    b.attr('disabled',null).html(previous);

                    swal('success', data.success, 'success').then(function () {
                        $('.verify-code-div').show();
                        $('.send-mail-div').hide();
                    });
                },
                error: function (xhr) {
                    b.attr('disabled',null).html(previous);

                    erroralert(xhr);
                },
            });
        });
        $(document).on('click','#check-code',function (e) {
            e.preventDefault();
            $('#2fa-modal').modal('show');
            var previous= $(this).text(),b=$(this);
            b.attr('disabled','disabled').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing ...');

            $.ajax({
                url: '{{route('two.factor.check.code')}}',
                type: "POST",
                dataType: "JSON",
                data: {'code':$('#code').val(),_token:'{{csrf_token()}}'},
                success: function (data) {
                    b.attr('disabled',null).html(previous);
                    var dollarValue = $('.dollar-value').val();
                    if (data==true){
                        $('#2fa-modal').hide();
                        $.ajax({
                            type: "post",
                            url: "{{route('store.coin.config')}}",
                            data: {_token: "{{csrf_token()}}", "dollar_value": dollarValue},
                            success: function (data) {
                                callback2FA();
                            }
                        })

                    } else{
                        $.toast({heading: 'Failed', text: 'Code doesn\'t matched', icon: 'error', position: 'top-right',});
                    }
                },
                error: function (xhr) {
                    b.attr('disabled',null).html(previous);
                    erroralert(xhr);
                },
            });
        });
        $(document).on('click','#re-send-code',function (e) {
            e.preventDefault();
            $('.verify-code-div').hide();
            $('.send-mail-div').show();
        });
    });
</script>
@endpush