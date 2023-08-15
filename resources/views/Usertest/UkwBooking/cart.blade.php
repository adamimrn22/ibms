<div id="cart-section" class="offcanvas-body">
    @if (empty($cart))
        <p>Tiada Barang di dalam troli.</p>
    @else
        <ul class="m-1 p-0">
            @foreach ($cart as $itemId => $item)
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column  justify-content-between align-items-baseline border py-1 mb-1 rounded"
                        data-item-id="{{ $item['id'] }}">
                        <p class="lead fw-normal mb-1 text-break">{{ $item['name'] }}</p>
                        <p class="mb-1">Quantity:</p>
                        <div class="input-group bootstrap-touchspin white-icon">
                            <button class="btn btn-primary btn-sm btn-decrement white-icon" type="button">
                                <img src="{{ asset('img/minus.png') }}" width="14px" alt="">
                            </button>

                            <input type="number" class="touchspin form-control " value="{{ $item['quantity'] }}">
                            <button class="btn btn-primary btn-sm btn-increment" type="button">
                                <img src="{{ asset('img/plus.png') }}" width="14px" alt="">
                            </button>
                        </div>
                        <span class="align-self-end text-danger btn-remove my-1" style="cursor: pointer;"
                            data-item-id="{{ $itemId }}"><u>Remove</u>
                        </span>
                    </div>
                </div>
            @endforeach
        </ul>

        <div>
            <p class=" text-danger btn-clear-cart" style="text-align: end; cursor: pointer;">Remove All</p>
            <a class="btn btn-primary w-100 checkoutHover" href="{{ route('cart.checkout') }}">Checkout</a>
        </div>
    @endif

</div>
