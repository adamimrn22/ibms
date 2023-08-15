<div id="cart-section">
    @if (empty($cart))
        <table width="100%">
            <tbody>
                <tr>
                    <td>Tiada Alatan Tulis di dalam troli</td>
                </tr>
            </tbody>
        </table>
    @else
        <table>
            <tbody>
                @forelse ($cart as $itemId => $item)
                    <tr data-item-id="{{ $item['id'] }}">
                        <hr>
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td class="pb-3">{{ $item['name'] }}</td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>

                                    <td data-item-id="{{ $item['id'] }}">
                                        <div class="input-group bootstrap-touchspin white-icon ms-auto" align="end">
                                            <button class="btn btn-primary btn-sm btn-decrement white-icon"
                                                type="button">
                                                <img src="{{ asset('img/minus.png') }}" width="14px" alt="">
                                            </button>

                                            <input type="number" class="touchspin form-control "
                                                value="{{ $item['quantity'] }}">
                                            <button class="btn btn-primary btn-sm btn-increment" type="button">
                                                <img src="{{ asset('img/plus.png') }}" width="14px" alt="">
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="removeBtn my-1 btn-remove" align="end" data-item-id="{{ $itemId }}">
                            Remove</div>
                        <hr>
                    </tr>
                @empty
                    <tr>
                        <td>Tiada Barang Di Dalam Troli</td>
                    </tr>
                @endforelse

                <div class="my-1 removeBtn btn-clear-cart" align="end">
                    <span>Remove All</span>
                </div>

                <a href="{{ route('AlatTulis.checkoutItem') }}"
                    class="btn btn-primary waves-effect waves-float waves-light w-100">
                    Checkout
                </a>

            </tbody>
        </table>
    @endif
</div>
