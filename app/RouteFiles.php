<?php

// Generate Route Files
function get_files_array($route_name)
{
    // dd($route_name);
    $files_array = array(
        $route_name=>array(
            "styles" => "profile,app,all,tags,tagsify,pre-loader,skeletel",
            "include_top" => "pre-loader,top-nav,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,index,profile,app,helpers",
            "in_script" => "universal"
        ),
        'login' => array(
            'title' => 'User Login - NP Social',
            "styles" => "login,pre-loader",
            "include_top" => "pre-loader",
            "scripts" => "pre-loader",
        ),
        'landing' => array(
            'title' => 'User Login - NP Social',
            "styles" => "login,pre-loader",
            "include_top" => "pre-loader",
            "scripts" => "pre-loader",
        ),

        'referral.link' => array(
            "styles" => "all,forgot,intlTelInput,pre-loader",
            "include_top" => "pre-loader",
            "include_bottom" => "footer",
            "scripts" => "intlTelInput,index,pre-loader",
        ),
        'landing.page' => array(
            "styles" => "all,forgot,intlTelInput,pre-loader",
            "include_top" => "pre-loader",
            "include_bottom" => "footer",
            "scripts" => "intlTelInput,index,pre-loader",
        ),
        'sign.up' => array(
            "styles" => "forgot,intlTelInput,pre-loader",
            "include_top" => "pre-loader",
            "scripts" => "intlTelInput,index,pre-loader",
        ),
        'sign.up.kyc.rejection' => array(
            "styles" => "forgot,intlTelInput,pre-loader",
            "include_top" => "pre-loader",
            "scripts" => "intlTelInput,index,pre-loader",
        ),

        'home' => array(
            "styles" => "profile,app,all,tags,tagsify,pre-loader,skeletel",
            "include_top" => "pre-loader,top-nav,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,index,profile,app,helpers",
            "in_script" => "universal"
        ),
          'privacy.policy' => array(
            'title' => 'User Login - NP Social',
            "styles" => "login,pre-loader",
            "include_top" => "pre-loader",
            "scripts" => "pre-loader",
        ),
        'register' => array(
            'title' => 'User Login - NP Social',
            "styles" => "login,pre-loader",
            "include_top" => "pre-loader",
            "scripts" => "pre-loader",
        ),
        'ambassador.profile' => array(
            "styles" => "profile,app,all,tags,tagsify,pre-loader,skeletel,i-uploader",
            "include_top" => "pre-loader,top-nav,cover,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,profile,universal,index,app,helpers,i-uploader",
            "in_script" => "universal"
        ),
        'settings' => array(
            "styles" => "profile,app,all,tags,tagsify,pre-loader,skeletel,i-uploader",
            "include_top" => "pre-loader,top-nav,navigation",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,profile,universal,index,app,helpers,i-uploader",
            "in_script" => "universal"
        ),
        'network.profile' => array(
            "styles" => "profile,app,all,tags,tagsify,pre-loader,skeletel,i-uploader",
            "include_top" => "pre-loader,top-nav,cart-popup,cover",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,profile,universal,index,app,helpers,i-uploader",
            "in_script" => "universal"
        ),
        'gallery' => array(
            "styles" => "profile,app,all,tags,tagsify,pre-loader,universal,skeletel",
            "include_top" => "pre-loader,top-nav,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,universal,profile,index,app,helpers",
            "in_script" => "universal"
        ),
        'network.gallery' => array(
            "styles" => "profile,app,all,tags,tagsify,pre-loader,universal,skeletel",
            "include_top" => "pre-loader,top-nav,cover,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,universal,profile,index,app,helpers",
            "in_script" => "universal"
        ),
        'network' => array(
            "styles" => "profile,app,all,tags,tagsify,pre-loader,universal,skeletel",
            "include_top" => "pre-loader,top-nav,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,universal,index,app,helpers",
            "in_script" => "universal"
        ),
        'network.list' => array(
            "styles" => "profile,app,all,tags,tagsify,pre-loader,universal,skeletel",
            "include_top" => "pre-loader,top-nav,cover,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,universal,index,app,helpers",
            "in_script" => "universal"
        ),
        'network.blocked' => array(
            "styles" => "profile,app,all,tags,tagsify,pre-loader,universal,skeletel",
            "include_top" => "pre-loader,top-nav,cover",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,universal,index,app,helpers",
            "in_script" => "universal"
        ),
        'ambassador.receipts' => array(
            "styles" => "kyc,profile,wallet,app,all,tags,tagsify,pre-loader,universal,skeletel,dataTable",
            "include_top" => "pre-loader,top-nav,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,universal,index,uploader,dataTable,dataTableBootstrap,app,helpers",
            "in_script" => "universal"
        ),
        'wallet.dashboard' => array(
            "styles" => "kyc,profile,app,all,wallet,tags,tagsify,pre-loader,universal,skeletel",
            "include_top" => "pre-loader,top-nav,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,universal,index,uploader,dataTable,dataTableBootstrap,chart,app,helpers",
            "in_script" => "universal"
        ),
        'network.dashboard' => array(
            "styles" => "kyc,profile,app,all,uploader,wallet,tags,tagsify,pre-loader,universal,skeletel,dataTable",
            "include_top" => "pre-loader,top-nav,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,universal,index,uploader,dataTable,dataTableBootstrap,chart,app,helpers,wallet",
            "in_script" => "universal"
        ),
        'network.extend' => array(
            "styles" => "kyc,profile,wallet,app,all,tags,tagsify,pre-loader,universal,skeletel,i-uploader,dataTable",
            "include_top" => "pre-loader,top-nav,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,universal,index,uploader,dataTable,dataTableBootstrap,chart,app,helpers,i-uploader",
            "in_script" => "universal"
        ),
        'wallet.coin.packages' => array(
            "styles" => "kyc,profile,app,all,uploader,wallet,tags,tagsify,pre-loader,universal,skeletel",
            "include_top" => "pre-loader,top-nav,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,universal,index,uploader,dataTable,dataTableBootstrap,chart,app,helpers",
            "in_script" => "universal"
        ),
        'wallet.transactions' => array(
            "styles" => "kyc,profile,app,all,wallet,uploader,tags,tagsify,pre-loader,universal,skeletel,dataTable",
            "include_top" => "pre-loader,top-nav,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,universal,index,uploader,dataTable,dataTableBootstrap,chart,app,helpers",
            "in_script" => "universal"
        ),
        'payment.method' => array(
            "styles" => "kyc,profile,app,all,wallet,uploader,tags,tagsify,pre-loader,universal,skeletel",
            "include_top" => "pre-loader,top-nav,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,universal,index,uploader,dataTable,dataTableBootstrap,chart,app,helpers",
            "in_script" => "universal"
        ),
        'cart.show' => array(
            "styles" => "wallet,cart,kyc,profile,app,all,tags,tagsify,pre-loader,universal,skeletel,iAlerts",
            "include_top" => "pre-loader,top-nav,navigation",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,universal,index,app,helpers",
            "in_script" => "universal"
        ),
        'search' => array(
            "styles" => "wallet,cart,kyc,profile,app,all,tags,tagsify,pre-loader,universal,skeletel,iAlerts",
            "include_top" => "pre-loader,top-nav,navigation",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,universal,index,app,helpers",
            "in_script" => "universal"
        ),
        'chat' => array(
            "styles" => "chat,profile,app,all,tags,tagsify,pre-loader,universal,skeletel,i-uploader",
            "include_top" => "pre-loader,top-nav,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,universal,index,uploader,dataTable,dataTableBootstrap,chart,app,helpers,i-uploader",
            "in_script" => "universal"
        ),
        'kyc.submission' => array(
            "styles" => "kyc,profile,app,all,tags,tagsify,pre-loader,universal,skeletel,i-uploader",
            "include_top" => "pre-loader,top-nav,cart-popup",
            "include_bottom" => "footer,modals,bottom-navigation",
            "scripts" => "pre-loader,tags,tags-prety,itrigger,universal,index,dataTable,dataTableBootstrap,chart,app,helpers,i-uploader",
            "in_script" => "universal"
        ),
        'verification.notice' => array(
            "styles" => "forgot,intlTelInput,pre-loader",
            "include_top" => "pre-loader",
            "scripts" => "intlTelInput,pre-loader,index",
        ),
        'password.request' => array(
            "styles" => "forgot,pre-loader",
            "include_top" => "pre-loader",
            "scripts" => "pre-loader",
        ),
        'forgot.send.email' => array(
            "styles" => "forgot,pre-loader",
            "include_top" => "pre-loader",
            "scripts" => "pre-loader",
        ),
        'forgot.create.new.password' => array(
            "styles" => "forgot,pre-loader",
            "include_top" => "pre-loader",
            "scripts" => "pre-loader",
        ),
    );
    return $files_array[$route_name];
}

?>