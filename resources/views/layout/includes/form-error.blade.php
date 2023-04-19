<div class="form-errors-div">
    <div class="form-errors-div-inner">
        <div class="form-errors-div-main">
            <div class="form-errors-div-single">
                <div class="form-error-div-single-main">
                    <div class="form-errors-div-single-inner">
                        <div class="form-errors-div-icon">
                            <div class="icon"><div class="ti-alert"></div></div>
                        </div>
                        <div class="form-errors-div-text">The 'Meta Title' field is required!</div>
                        <div class="form-errors-div-dismiss">
                            <div class="icon"><div class="ti-close"></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-errors-div-single">
                <div class="form-error-div-single-main">
                    <div class="form-errors-div-single-inner">
                        <div class="form-errors-div-icon">
                            <div class="icon"><div class="ti-alert"></div></div>
                        </div>
                        <div class="form-errors-div-text">The 'Meta Image' field is required!</div>
                        <div class="form-errors-div-dismiss">
                            <div class="icon"><div class="ti-close"></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-errors-div-single">
                <div class="form-error-div-single-main">
                    <div class="form-errors-div-single-inner">
                        <div class="form-errors-div-icon">
                            <div class="icon"><div class="ti-alert"></div></div>
                        </div>
                        <div class="form-errors-div-text">The 'Meta Image' field is required!</div>
                        <div class="form-errors-div-dismiss">
                            <div class="icon"><div class="ti-close"></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-errors-div-single">
                <div class="form-error-div-single-main">
                    <div class="form-errors-div-single-inner">
                        <div class="form-errors-div-icon">
                            <div class="icon"><div class="ti-alert"></div></div>
                        </div>
                        <div class="form-errors-div-text">The 'Meta Image' field is required!</div>
                        <div class="form-errors-div-dismiss">
                            <div class="icon"><div class="ti-close"></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-errors-div-single">
                <div class="form-error-div-single-main">
                    <div class="form-errors-div-single-inner">
                        <div class="form-errors-div-icon">
                            <div class="icon"><div class="ti-alert"></div></div>
                        </div>
                        <div class="form-errors-div-text">The 'Meta Image' field is required!</div>
                        <div class="form-errors-div-dismiss">
                            <div class="icon"><div class="ti-close"></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-errors-div-single">
                <div class="form-error-div-single-main">
                    <div class="form-errors-div-single-inner">
                        <div class="form-errors-div-icon">
                            <div class="icon"><div class="ti-alert"></div></div>
                        </div>
                        <div class="form-errors-div-text">The 'Meta Image' field is required!</div>
                        <div class="form-errors-div-dismiss">
                            <div class="icon"><div class="ti-close"></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-errors-div-single">
                <div class="form-error-div-single-main">
                    <div class="form-errors-div-single-inner">
                        <div class="form-errors-div-icon">
                            <div class="icon"><div class="ti-alert"></div></div>
                        </div>
                        <div class="form-errors-div-text">The 'Meta Image' field is required!</div>
                        <div class="form-errors-div-dismiss">
                            <div class="icon"><div class="ti-close"></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-errors-div-single">
                <div class="form-error-div-single-main">
                    <div class="form-errors-div-single-inner">
                        <div class="form-errors-div-icon">
                            <div class="icon"><div class="ti-alert"></div></div>
                        </div>
                        <div class="form-errors-div-text">The 'Meta Image' field is required!</div>
                        <div class="form-errors-div-dismiss">
                            <div class="icon"><div class="ti-close"></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-errors-div-single">
                <div class="form-error-div-single-main">
                    <div class="form-errors-div-single-inner">
                        <div class="form-errors-div-icon">
                            <div class="icon"><div class="ti-alert"></div></div>
                        </div>
                        <div class="form-errors-div-text">The 'Meta Image' field is required!</div>
                        <div class="form-errors-div-dismiss">
                            <div class="icon"><div class="ti-close"></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-errors-div-single">
                <div class="form-error-div-single-main">
                    <div class="form-errors-div-single-inner">
                        <div class="form-errors-div-icon">
                            <div class="icon"><div class="ti-alert"></div></div>
                        </div>
                        <div class="form-errors-div-text">The 'Meta Image' field is required!</div>
                        <div class="form-errors-div-dismiss">
                            <div class="icon"><div class="ti-close"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        // setTimeout(function() {
            var error_count = $('.form-error-div-single-main').length;
            // var error_count_for = error_count-1;
            // for(var i=0; i < error_count; i++){
                var error_i = 0;
                setInterval(function() {
                    $('.form-error-div-single-main:eq('+error_i+')').addClass('error-animation');
                    console.log(error_i)
                    error_i = error_i+1;
                }, 100);
            // }
        //     $('.form-errors-div-single').each(function(){
        //         console.log('1');
        //     setTimeout(function() {
        //         $(this).addClass('error-animation');
        //     }, 1500);
        // });
        // }, 2000);
    });
</script>