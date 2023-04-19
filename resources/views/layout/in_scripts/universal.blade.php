<script>
    $(document).on('click','.open-modal',function() {
       var modal_id = $(this) .attr('data-modal');
       $(modal_id).modal('show',true);
    });
    // $(".top-open-menu").click(function () {
    //     var data_menu_class = $(this).attr("data-target");
    //     $(data_menu_class).toggle();
    // });
    $(function () {
        $('#email-tags').tagsinput({});

        // Close PopUp
        $(document).on('click','.close-post-popup',function() {
            $('body').removeClass('show-post');
            $('.single-post-pop-up').hide(500);
        });

        // Show DropDown
        // $(document).on('click','.open-dropdown',function() {
        //     var dropdown_class = $(this).attr('data-target')
        //     $(dropdown_class).show();
        // })
        // Hide Search
        $(document).on('click','.close-recent-search',function() {
            $(".recent-searches-box").hide();
        });
        // Show PopOver
        $(document).on('click','.show-popover',function() {
            var popover_class = $(this).attr('data-popover');
            $(popover_class).show();
            setTimeout(function() {
                $(popover_class).hide();
            },1000);
            $('#referral-link-text').select();
            document.execCommand("copy");
        });
     

   $(document).on('input paste','.key-drop-down',function () {
       var search_of = $('#search_by_value').val();
       search_dropdown($(this).val(),search_of);
       });
   });

   $(document).on('click','.search-of li',function(){
      var search_of = $(this).attr('data-value');
      var search_word = $('.key-drop-down').val();
      search_dropdown(search_word,search_of);
   });

   

</script>