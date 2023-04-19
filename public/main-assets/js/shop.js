 function addToCart(url,token,qty,product_id){
    $.ajax({
        type : "post",
        url  : url,
        data : {_token : token, 'product_id' : product_id , 'quantity' : qty},
        success : function(data){
            swal("success","Product Added To cart","success");
        },
        error : function(xhr){
             erroralert(xhr);
        }

    });
}

function addToWishlist(url,token,user_id,product_id)
{
    $.ajax({
        type: "post",
        url : url,
        data: {_token : token , "user_id" : user_id , "product_id" : product_id},
        success : function(data){
            if(data.key == '1'){
            $('.add-to-wishlist').html('<span class="icon"><span class="ti-check-box" ></span></span><div class="text">Remove</div>');
            }else{
            $('.add-to-wishlist').html('<span class="icon"><span class="ti-heart" ></span></span><div class="text"> Add to WishList </div>');
            }
        },
        error : function(xhr){
            erroralert(xhr);
        }
    });
}