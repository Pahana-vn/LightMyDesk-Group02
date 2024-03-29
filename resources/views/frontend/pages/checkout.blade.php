@extends('frontend.layoutFE')
@section('contentFE')
<?php
if(!empty(Session::get("cart"))){
if(!empty(Auth::user())){
?>
 <!-- breadcrumb start -->
 <div class="breadcrumb">
    <div class="container">
        <ul class="list-unstyled d-flex align-items-center m-0">
            <li><a href="{{route('fe.home')}}">Home</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path
                            d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                            fill="#000" />
                    </g>
                </svg>
            </li>
            <li>Cart</li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path
                            d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                            fill="#000" />
                    </g>
                </svg>
            </li>
            <li>Checkout</li>
        </ul>
    </div>
</div>
<!-- breadcrumb end -->

<div class="checkout-page mt-100">
    <div class="container">
        <?php
        if(Auth::check()){

          ?>
        <div class="checkout-page-wrapper">
            <div class="row">
                <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                    <div class="section-header mb-3">
                        <h2 class="section-heading">Check out</h2>
                    </div>

                    <div class="checkout-progress overflow-hidden">
                        <ol class="checkout-bar px-0">
                            <li class="progress-step step-done"><a href="cart.html">Cart</a></li>
                            <li class="progress-step step-active"><a href="checkout.html">Your Details</a></li>
                            <li class="progress-step step-todo"><a href="checkout.html">Shipping</a></li>
                            {{-- <li class="progress-step step-todo"><a href="checkout.html">Payment</a></li>
                            <li class="progress-step step-todo"><a href="checkout.html">Review</a></li> --}}
                        </ol>
                    </div>

                    <div class="checkout-user-area overflow-hidden d-flex align-items-center">
                        <div class="checkout-user-img me-4">
                            <img src="{{asset('public/file/')}}/people/{{ rand(1,9) }}.jpg" alt="img">
                        </div>
                        <div class="checkout-user-details d-flex align-items-center justify-content-between w-100">
                            <div class="checkout-user-info">

                                <h2 class="checkout-user-name">Name: <?php echo Auth::user()->fullname; ?></h2>
                                <p class="checkout-user-address mb-0">Address: <?php echo Auth::user()->address; ?></p>
                                <p class="checkout-user-address mb-0">Phone <?php echo Auth::user()->phone; ?></p>
                            </div>

                            <a href="{{route('fe.profile')}}" class="edit-user btn-secondary">EDIT PROFILE</a>
                        </div>
                    </div>


                    <script>
                        function showQRCode(checkbox) {
                        var qrCodeSection = document.getElementById("qrCodeSection");
                        if (checkbox.checked) {
                            qrCodeSection.style.display = "block"; // Show QR code section
                        } else {
                            qrCodeSection.style.display = "none"; // Hide QR code section
                        }
                    }

                    </script>

                    <form action="{{route('fe.checkout')}}" method="POST">
                        @csrf
                        <div class="shipping-address-area billing-area">
                            <h2 class="shipping-address-heading pb-1">Billing address</h2>
                            <div class="form-checkbox d-flex align-items-center mt-4">
                                <input class="form-check-input mt-0" type="radio" name="payment" value="1" checked>
                                <label class="form-check-label ms-2">
                                    Pay directly when ordering
                                </label>
                            </div>

                            <div class="form-checkbox d-flex align-items-center mt-4">
                                <input class="form-check-input mt-0" type="radio" name="payment" value="2" onchange="showQRCode(this)">
                                <label class="form-check-label ms-2">
                                    Payment via momo QR code transfer
                            </label>
                            </div>
                            <div id="qrCodeSection" style="display: none;">
                                <img style="width: 250px; height: 250px;" src="{{asset('public/frontend')}}/img/maqr/qrcode2.png" alt="QR Code"> <br>
                                <h4>Please enter transfer content: LMD <?php echo Auth::user()->id; ?>
                                </h4>
                            </div>
                        </div>
                    <div class="shipping-address-area billing-area">
                        <div class="minicart-btn-area d-flex align-items-center justify-content-between flex-wrap">
                            <a href="{{route('fe.cart')}}" class="checkout-page-btn minicart-btn btn-secondary">BACK TO CART</a>
                            <button type="submit" href="{{route('fe.checkout')}}" class="checkout-page-btn minicart-btn btn-primary">PROCEED TO SHIPPING</button>
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                    <div class="cart-total-area checkout-summary-area">
                        <h3 class="d-none d-lg-block mb-0 text-center heading_24 mb-4">Order summary</h4>
                            <?php
                            $Subtotal=0; $total=0; $originalPrice = 0; $discount = 0; $finalPrice = 0;
                             foreach(Session::get("cart") as $item ) {
                                ?>

                        <div class="minicart-item d-flex">
                            <div class="mini-img-wrapper">
                                <img class="mini-img" src="{{asset('public/file')}}/image/{{$item['image']}}" alt="img">
                            </div>
                            <div class="product-info">
                                <h2 class="product-title"><a href="#">{{$item['name']}}</a></h2>
                                <p class="product-vendor"><?php echo "$".$item['price']." "."x"." ".$item['soluong']; ?></p>
                            </div>
                        </div>
                        <?php
                        // $Subtotal=$Subtotal+$item['soluong']*$item['price'];
                        $originalPrice = $originalPrice + $item['price'] * $item['soluong']; // Tính giá gốc
                        $discount = $originalPrice * ($item['discount'] / 100); // Tính số tiền được giảm giá
                        $finalPrice = $originalPrice - $discount; // Tính giá sau khi giảm giá
                        } ?>

                        <div class="cart-total-box mt-4 bg-transparent p-0">
                            <div class="subtotal-item subtotal-box">
                                <h4 class="subtotal-title">Subtotals:</h4>
                                <p class="subtotal-value">${{$originalPrice}}</p>
                            </div>
                            <div class="subtotal-item shipping-box">
                                <h4 class="subtotal-title">Shipping:</h4>
                                <p class="subtotal-value">$10.00</p>
                            </div>
                            <div class="subtotal-item discount-box">
                                <h4 class="subtotal-title">Discount:</h4>
                                <p class="subtotal-value">-${{$discount}}</p>
                            </div>
                            <hr />
                            <div class="subtotal-item discount-box">
                                <h4 class="subtotal-title">Total:</h4>
                                <p class="subtotal-value">${{$originalPrice - $discount + 10}}</p>
                            </div>


                            {{-- <div class="mt-4 checkout-promo-code">
                                <input class="input-promo-code" type="text" placeholder="Promo code" />
                                <a href="checkout.html" class="btn-apply-code position-relative btn-secondary text-uppercase mt-3">
                                    Apply Promo Code
                                </a>
                            </div> --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <?php }else{ ?>
        vui lòng đăng ký tài khoản
        <br>
        <a href="{{route('fe.register')}}">Đăng ký tài khoản</a>

        <?php } ?>
</div>
<?php
}else{
    ?>
     <!-- breadcrumb start -->
 <div class="breadcrumb">
    <div class="container">
        <ul class="list-unstyled d-flex align-items-center m-0">
            <li><a href="{{route('fe.home')}}">Home</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path
                            d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                            fill="#000" />
                    </g>
                </svg>
            </li>
            <li>Cart</li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path
                            d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                            fill="#000" />
                    </g>
                </svg>
            </li>
            <li>Checkout</li>
        </ul>
    </div>
</div>
<!-- breadcrumb end -->

<div class="checkout-page mt-100">
    <div class="container">

        <div class="checkout-page-wrapper">
            <div class="row">
                <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                    <div class="section-header mb-3">
                        <h2 class="section-heading">Check out</h2>
                    </div>

                    <div class="checkout-progress overflow-hidden">
                        <ol class="checkout-bar px-0">
                            <li class="progress-step step-done"><a href="cart.html">Cart</a></li>
                            <li class="progress-step step-active"><a href="checkout.html">Your Details</a></li>
                            <li class="progress-step step-todo"><a href="checkout.html">Shipping</a></li>
                            {{-- <li class="progress-step step-todo"><a href="checkout.html">Payment</a></li>
                            <li class="progress-step step-todo"><a href="checkout.html">Review</a></li> --}}
                        </ol>
                    </div>



                    <div class="shipping-address-area">
                        <h2 class="shipping-address-heading pb-1">Shipping address</h2>
                        <div class="shipping-address-form-wrapper">
                            <form action="" class="shipping-address-form common-form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label class="label">First name</label>
                                            <input type="text" />
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label class="label">Last name</label>
                                            <input type="text" />
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label class="label">Email address</label>
                                            <input type="email" />
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label class="label">Phone number</label>
                                            <input type="text" />
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label class="label">Company</label>
                                            <input type="text" />
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label class="label">Country</label>
                                            <select class="form-select">
                                                <option selected="ca">Canada</option>
                                                <option value="us">USA</option>
                                                <option value="au">Australia</option>
                                                <option value="me">Mexico</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label class="label">City</label>
                                            <select class="form-select">
                                                <option selected="ca">Toronto</option>
                                                <option value="us">Quebec</option>
                                                <option value="au">Windsor</option>
                                                <option value="me">Calgary</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label class="label">Zip code</label>
                                            <input type="text" />
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label class="label">Address 1</label>
                                            <input type="text" />
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label class="label">Address 2</label>
                                            <input type="text" />
                                        </fieldset>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="shipping-address-area billing-area">
                        <h2 class="shipping-address-heading pb-1">Billing address</h2>
                        <div class="form-checkbox d-flex align-items-center mt-4">
                            <input class="form-check-input mt-0" type="checkbox" checked>
                            <label class="form-check-label ms-2">
                                Pay directly when ordering
                            </label>
                        </div>

                        <div class="form-checkbox d-flex align-items-center mt-4">
                            <input class="form-check-input mt-0" type="checkbox" onchange="showQRCode(this)">
                            <label class="form-check-label ms-2">
                                Payment via momo QR code transfer
                        </label>
                        </div>
                        <div id="qrCodeSection" style="display: none;">
                            <img style="width: 250px; height: 250px;" src="{{asset('public/frontend')}}/img/maqr/qrcode2.png" alt="QR Code"> <br>
                            <h4>Please enter transfer content: LMD + email</h4>
                        </div>
                    </div>
                    <script>
                        function showQRCode(checkbox) {
            var qrCodeSection = document.getElementById("qrCodeSection");
            if (checkbox.checked) {
                qrCodeSection.style.display = "block"; // Show QR code section
            } else {
                qrCodeSection.style.display = "none"; // Hide QR code section
            }
        }

                    </script>

                    <form action="" >
                        @csrf
                    <div class="shipping-address-area billing-area">
                        <div class="minicart-btn-area d-flex align-items-center justify-content-between flex-wrap">
                            <a href="{{route('fe.cart')}}" class="checkout-page-btn minicart-btn btn-secondary">BACK TO CART</a>
                            <button type="submit" href="" class="checkout-page-btn minicart-btn btn-primary">PROCEED TO SHIPPING</button>
                        </div>
                    </div>
                </form>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                    <div class="cart-total-area checkout-summary-area">
                        <h3 class="d-none d-lg-block mb-0 text-center heading_24 mb-4">Order summary</h4>
                            <?php
                            $Subtotal=0; $total=0; $originalPrice = 0; $discount = 0; $finalPrice = 0;
                             foreach(Session::get("cart") as $item ) {
                                ?>

                        <div class="minicart-item d-flex">
                            <div class="mini-img-wrapper">
                                <img class="mini-img" src="{{asset('public/file')}}/image/{{$item['image']}}" alt="img">
                            </div>
                            <div class="product-info">
                                <h2 class="product-title"><a href="#">{{$item['name']}}</a></h2>
                                <p class="product-vendor"><?php echo "$".$item['price']." "."x"." ".$item['soluong']; ?></p>
                            </div>
                        </div>
                        <?php
                        // $Subtotal=$Subtotal+$item['soluong']*$item['price'];
                        $originalPrice = $originalPrice + $item['price'] * $item['soluong']; // Tính giá gốc
                        $discount = $originalPrice * ($item['discount'] / 100); // Tính số tiền được giảm giá
                        $finalPrice = $originalPrice - $discount; // Tính giá sau khi giảm giá
                        } ?>

                        <div class="cart-total-box mt-4 bg-transparent p-0">
                            <div class="subtotal-item subtotal-box">
                                <h4 class="subtotal-title">Subtotals:</h4>
                                <p class="subtotal-value">${{$originalPrice}}</p>
                            </div>
                            <div class="subtotal-item shipping-box">
                                <h4 class="subtotal-title">Shipping:</h4>
                                <p class="subtotal-value">$10.00</p>
                            </div>
                            <div class="subtotal-item discount-box">
                                <h4 class="subtotal-title">Discount:</h4>
                                <p class="subtotal-value">-${{$discount}}</p>
                            </div>
                            <hr />
                            <div class="subtotal-item discount-box">
                                <h4 class="subtotal-title">Total:</h4>
                                <p class="subtotal-value">${{$originalPrice - $discount + 10}}</p>
                            </div>


                            {{-- <div class="mt-4 checkout-promo-code">
                                <input class="input-promo-code" type="text" placeholder="Promo code" />
                                <a href="checkout.html" class="btn-apply-code position-relative btn-secondary text-uppercase mt-3">
                                    Apply Promo Code
                                </a>
                            </div> --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</div>
<?php
}}else {
    ?>
    <script>
        alert("Cart is empty not pay");
    </script>
<?php
}
?>
@endsection
