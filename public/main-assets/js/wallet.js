// All Wallet Functions

var show_tier_parent_class = '.wallet-stats-graph-list-boxed-main.tier-div';
$(document).on("click",".show-tiers",function(){
    var target_class = $(this).attr('data-class');
    $('.show-tiers').removeClass('active')
    $(this).addClass('active');
    $(show_tier_parent_class).removeClass('active');
    $(target_class).addClass('active')
});