<div class="cart-pop-up-outer">
    <div class="cart-pop-up-outer-iner">
        <div class="cart-pop-up-main">
            <div class="cart-pop-up-top-bar">
                <div class="cart-pop-up-top-bar-title">
                    Shopping Cart
                </div>
                <div class="cart-picking-option-outer">
                    <div class="cart-picking-option-inner">
                        <div class="cart-picking-options">
                            <div class="cart-picking-option-single">
                                <div class="cart-picking-option-single-inner">
                                    <div class="cart-picking-option-button">
                                        <button>Pickup</button>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-picking-option-single">
                                <div class="cart-picking-option-single-inner">
                                    <div class="cart-picking-option-button">
                                        <button>Delivery</button>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-picking-option-single">
                                <div class="cart-picking-option-single-inner">
                                    <div class="cart-picking-option-info">
                                        <span class="ti-info-alt"></span>
                                        <div class="cart-picking-option-info-overlay">
                                            <div class="cart-picking-option-info-overlay-inner">
                                                <div class="cart-picking-option-info-overlay-outer">
                                                    <ul class="cart-picking-option-info-overlay-ul">
                                                        <li class="cart-picking-option-info-overlay-li">
                                                            <b>1 hour delivery:</b> For quick delivery An Additional
                                                            $4.99 for 1 hour delivery.
                                                        </li>
                                                        <li class="cart-picking-option-info-overlay-li">
                                                            <b>24 hours delivery</b> Product will be dropped off within
                                                            1 day.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cart-popup-items">
                    <div class="cart-popup-items-inner">
                        <div class="cart-popup-items-all">
                            @php $total=0; @endphp
                            @if(isset($cartItems))
                                @foreach($cartItems as $item)
                                    @php $total+=($item['product']['price']*$item['qty']); @endphp
                                    <div class="cart-popup-items-single">
                                        <div class="cart-popup-items-single-inner">
                                            <div class="cart-popup-items-single-qty">{{$item['qty']}}x</div>
                                            <div class="cart-popup-items-single-name">{{$item['product']['name']}}</div>
                                            <div class="cart-popup-items-single-qty-control">
                                                <div class="cart-popup-items-single-control-single qty-decrease cart-item-update"
                                                     data-type="minus" data-product-id="{{$item['product']['id']}}">
                                                    <span class="ti-minus"></span>
                                                </div>
                                                <div class="cart-popup-items-single-control-single qyt-increase cart-item-update"
                                                     data-type="plus" data-product-id="{{$item['product']['id']}}">
                                                    <span class="ti-plus"></span>
                                                </div>
                                            </div>
                                            <div class="cart-popup-items-single-price">
                                                ${{$item['product']['price']}}
                                            </div>
                                            <div class="cart-popup-items-single-item-control">
                                                <div class="cart-popup-items-item-control-single cart-item-remove"
                                                     data-product-id="{{$item['product']['id']}}">
                                                    <span class="ti-trash"></span>
                                                </div>
                                            </div>
                                            <div class="cart-popup-items-single-item-control">
                                                <div class="cart-popup-items-item-control-single item-delete">
                                                    <span class="ti-comment-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart-popup-items-single-comment-box">
                                            <div class="cart-popup-items-single-comment-box-inner">
                                            <textarea class="cart-popup-items-single-comment-field"
                                                      placeholder="Comments"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="cart-popup-items-single">
                                    Your cart is empty !
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="cart-popup-total-rows">
                    <div class="cart-popup-total-rows-inner">
                        <div class="cart-popup-total-rows-all">
                            <div class="cart-popup-total-row-single">
                                <div class="cart-popup-total-row-single-inner">
                                    <div class="title">Subtotal</div>
                                    <div class="value">${{$total}}</div>
                                </div>
                            </div>
                            <div class="cart-popup-total-row-single">
                                <div class="cart-popup-total-row-single-inner">
                                    <div class="title">Delivery Cost</div>
                                    <div class="value">0</div>
                                </div>
                            </div>
                            <div class="cart-popup-total-row-single total">
                                <div class="cart-popup-total-row-single-inner">
                                    <div class="title">Total</div>
                                    <div class="value">{{$total}}</div>
                                </div>
                            </div>
                            <div class="cart-popup-total-row-single required">
                                <div class="cart-popup-total-row-single-inner">
                                    <div class="title">Amount required to reach the minimum order value</div>
                                    <div class="value">$50.00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cart-popup-bottom-allert">
                    <div class="cart-popup-bottom-alert-text">
                        Unfortunately you cannot order yet. Merchants only delivers from a minimum order value of $10.00
                        (excl. Delivery costs).
                    </div>
                </div>
                <div class="cart-popup-bottom-checkout">
                    <div class="cart-popup-bottom-checkout-button">
                        <button>Check Out</button>
                    </div>
                </div>
            </div>
            <div class="cart-popup-close-button">
                <div class="cart-popup-close-button-inner" onclick="$('.cart-pop-up-outer').hide()">
                    <span class="ti-close"></span>
                </div>
            </div>
        </div>
    </div>
</div>