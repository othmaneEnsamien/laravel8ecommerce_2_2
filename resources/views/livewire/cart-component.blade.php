
<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>Cart</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            @if(Cart::instance('cart')->count()>0)
            <div class="wrap-iten-in-cart">
                @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <strong>Success</strong>{{ Session::get('success_message') }}
                    </div>
                @endif
                @if(Cart::instance('cart')->count()>0)
                <h3 class="box-title">Products Name</h3>
                <ul class="products-cart">
                    @foreach(Cart::instance('cart')->content() as $item)
                    <li class="pr-cart-item">
                        <div class="product-image">
                            <figure><img src="{{ asset('assets/images/products')}}/{{ $item->model->image}}" alt="{{ $item->model->name }}"></figure>
                        </div>
                        <div class="product-name">
                            <a class="link-to-product" href="{{ route('product.details',['slug'=>$item->model->slug]) }}">{{ $item->name }}</a>
                        </div>

                        @foreach($item->options as $key=>$value)
                            <div style="vertical-align:middle;width:180px;">
                                <p><b>{{ $key }}:{{ $value }}</b></p>
                            </div>
                        @endforeach

                        <div class="price-field produtc-price"><p class="price">${{ $item->model->regular_price }}</p></div>
                        <div class="quantity">
                            <div class="quantity-input">
                                <input type="text" name="product-quatity" value="{{ $item->qty }}" data-max="120" pattern="[0-9]*" >									
                                <a class="btn btn-increase" href="#" wire:click.prevent="increaseQuantity('{{ $item->rowId }}')"></a>
                                <a class="btn btn-reduce" href="#" wire:click.prevent="decreaseQuantity('{{ $item->rowId }}')"></a>
                            </div>
                        </div>
                        <div class="price-field sub-total"><p class="price">${{ $item->subtotal }}</p></div>
                        <div class="delete">
                            <a href="#" wire:click.prevent="destroy('{{ $item->rowId }}')" class="btn btn-delete" title="">
                                <span>Delete from your cart</span>
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                    </li>
                   	@endforeach								
                </ul>
                @else 
                     <div class="text-center" style=" padding:30px 0;text-shadow: 2ox 1px red;">
                    <strong>no item in cart</strong>
                    </div>
                @endif
            </div>

            <div class="summary">
                <div class="order-summary">
                    <h4 class="title-box">Order Summary</h4>
                    <p class="summary-info"><span class="title">Subtotal</span><b class="index">${{ Cart::instance('cart')->subtotal() }}</b></p>
                    @if(Session::has('coupon'))
                    <p class="summary-info"><span class="title">Discount({{ Session::get('coupon')['code'] }})<a href="#" wire:click.prevent="removeCoupon"><i class="fa fa-times text-danger"></i></span><b class="index">-${{ $discount }}</b></p>
                    <p class="summary-info"><span class="title">Subtotal With Discount</span><b class="index">${{ $subtotalAfterDiscount }}</b></p>
                    <p class="summary-info"><span class="title">Tax ({{ config('cart.tax') }}%)</span><b class="index">${{ $taxAfterDiscount }}</b></p>
                   <p class="summary-info"><span class="title">La livraison</span><b class="index">Casa:20dh
                            <br>
                        hors Casa : 30dh</b></p>
                    <p class="summary-info"><span class="title">Total</span><b class="index">${{ $totalAfterDiscount }}</b></p>
                    @else
                    <p class="summary-info"><span class="title">Tax</span><b class="index">${{ Cart::instance('cart')->tax() }}</b></p>
                    <div style="display:flex">
                        <p class="summary-info" style="margin-right:15px"><span class="title">La livraison:</span></p>
                        <p class="summary-info"><span class="title">La livraison</span><b class="index">Casa:20dh
                            <br>
                        hors Casa : 30dh</b></p>
                    </div>
                  
                    <p class="summary-info total-info "><span class="title">Total</span><b class="index">${{ Cart::instance('cart')->total() }}</b></p>
                    @endif
                </div>
               
                <div class="checkout-info">
                    @if(!Session::has('coupon'))
                    <label class="checkbox-field">
                        <input class="frm-input " name="have-code" id="have-code" value="1" type="checkbox" wire:model="haveCouponCode"><span>I have coupon code</span>
                    </label>
                    @if($haveCouponCode == 1)
                        <div class="summary-item">
                            <form  wire:submit.prevent="applyCouponCode">
                                <h4 class="title-box">Code promos</h4>
                                @if(Session::has('message_coupon'))
                                    <div class="alert alert-danger" role="danger">{{ Session::get('message_coupon') }}</div>
                               @endif
                                <p class="row-in-form">
                                    <label for="coupon-code">Enter your coupon code:</label>
                                    <input type="text" name="coupon-code" wire:model="couponCode">
                                </p>
                                <button type="submit" class="btn btn-small">Appliquer</button>
                            </form>
                        </div>
                    @endif
                    @endif
                    <a class="btn btn-checkout" href="#" wire:click.prevent="checkout">Commander maintenant</a>
                    <a class="link-to-shop" href="shop.html">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </div>
                <div class="update-clear">
                    <a class="btn btn-clear" href="#" wire:click.prevent="destroyAll()">Clear Shopping Cart</a>
                    <a class="btn btn-update" href="#">Update Shopping Cart</a>
                </div>
            </div>
            @else
                <div class="text-center" style="padding: 30px 0;">
                    <h1>Your Cart is Empty</h1>
                    <p>Add items to it now</p>
                    <a href="/shop" class="btn btn-success">Shop Now</a>
                </div>
            @endif

            {{-- related products --}}
            <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">Les Populaires Produits</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >
                            @foreach($popular_products as $r_product)
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{ route('product.details',['slug'=>$r_product->slug]) }}" title="{{ $r_product->name }}">
                                            <figure><img style="width: 900px;height:300px" src="{{ asset('assets/images/products')}}/{{ $r_product->image }}"  alt="{{ $r_product->name }}"></figure>
                                        </a>
                                        <div class="group-flash">
                                            <span class="flash-item new-label">new</span>
                                        </div>
                                        <div class="wrap-btn">
                                            <a href="#" class="function-link">quick view</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('product.details',['slug'=>$r_product->slug]) }}" class="product-name"><span>{{ $r_product->name }}</span></a>
                                        <div class="wrap-price"><span class="product-price">{{ $r_product->regular_price }}</span></div>
                                    </div>
                                </div>
                            @endforeach

                           

                        </div>
                    </div><!--End wrap-products-->
                </div>
            </div>
             {{-- end related products --}}

        </div>
    </div>

</main>
