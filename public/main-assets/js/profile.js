$(document).ready(function(){
    $('.upload-selector').click(function(){
        var target = $(this).attr('data-target');
        $(target).trigger('click');
    });

    // Will Open Editor for About
    $(".edit-button").click(function() {
        var type = $(this).attr('data-type');
        if (type == 'div') {
            var target = $(this).attr('data-target');
            var class_hide = $(this).attr('data-hide');
            $(class_hide).hide();
            $(target).show();
        }
    });

    // Will Open all Privacy DropDown
    // $('.open-dropdown').click(function () {
    //     var target = $(this).attr('data-target');
    //     $(target).toggle();
    // });



    // Open Post Editor

    $(document).on('click','.open-post-editor',function() {
        var target = $(this).attr("data-target");
        var hide_close = $(this).attr("data-close");
        $(hide_close).toggle();
        $(target).toggle();
    });

    // $("#exampleModal").modal('show',true);

    $('.set-privacy-dropdown-inner').html($('#privacy_dropdown').html());
    $(document).on('click','.set-privacy-dropdown-li',function () {
        var dropdownContainer = $(this).closest('.set-privacy-dropdown-inner');
        var icon = $(this).find('img');
        var text = $(this).find('.text');
        $(this).parent().parent().parent().find('.set-privacy-dropdown-value').attr('data-value', $(this).attr('data-value'));
        var next_icon = $(this).parent().parent().siblings().find('img');
        var next_text = $(this).parent().parent().siblings().find('i');
        $(next_icon).attr('src', $(icon).attr('src'));
        $(next_text).html($(text).html());
        $(this).parent().parent().removeClass('active');
        if (dropdownContainer.hasClass('social-privacy')) {
            changePrivacy($(dropdownContainer).attr('data-key'), $(this).attr('data-value'));
        }
    });
});