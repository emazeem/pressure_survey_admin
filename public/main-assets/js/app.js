// All Custom Scripts

// Open DropDowns

$(document).ready(function() {
    // Init Vars
    var dropdown_box = ".dropdown-box";
    var dropdown_class = ".custom-dropdown";
    
    // Open DropDown
    $(document).on('click','.open-dropdown',function() {
        var target = $(this).attr('data-target')
        console.log(target)
        if (!check_activity($(target))) {
            $(target).addClass('active');
        } else {
            $(target).removeClass('active');
        }
    });

    // Helper Function
    function check_activity(element) {
        return (element.hasClass('active')) ? true : false ;
    }

    // Close on Document Click
    $(window).click(function(event) {
        if (!$(event.target).closest(dropdown_box).length){
            $(dropdown_class).removeClass('active');
        }
    });

    // Close Search Box
    $(document).on('click','.close-recent-search',function(){
        $(".recent-searches-box").removeClass('active');
    });

    $(document).on('click','.search-button-popup',function() {
        $('#key-dropdown').focus();
    })

    $(document).on('click','.search-by-li',function(){
        var value = $(this).attr('data-value');
        var text = $(this).attr('data-text');
        $('#search_by_value').val(value);
        $('#search_by_text').text(text);
        $('.search-by-main').hide();
    });
});