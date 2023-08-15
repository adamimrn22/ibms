@extends('layouts.userapp')
@section('layout')
    <div class="container p-1" style="min-height: 100vh">
        <div class="row">
            <div class="col-lg-8">
                @foreach ($carts as $cart)
                    <div class="bg-white floating-box mb-1">
                        <div class="row border m-0 p-0">
                            <div class="col-md-4 text-center">
                                <img class="img-checkout p-1" src="{{ asset('storage/supply/' . $cart['image']) }}"
                                    alt="">
                            </div>
                            <div class="col-md-8 centerItem">
                                <div class="p-2">
                                    <h3 class="item-details">{{ $cart['name'] }}</h3>
                                    <div class="d-inline-flex">
                                        <p>Quantity:</p>
                                        <h4 class="mx-1">{{ $cart['quantity'] }}x</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-lg-4">
                <div class="bg-white floating-box">
                    <div class="p-3">
                        <h4>Maklumat Checkout</h4>
                        <div class="price-details">
                            <div class="d-flex justify-content-between">
                                <h6 class="price-title">Butir Pengguna </h6>
                                <span class="badge rounded-pill badge-light-primary">{{ Auth::user()->username }}</span>
                            </div>
                            <ul class="list-unstyled">
                                <li class="price-detail">
                                    <div class="detail-title">Nama:</div>
                                    <div class="detail-amt discount-amt text-success">
                                        {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</div>
                                </li>
                                <li class="price-detail">
                                    <div class="detail-title">Tarikh:</div>
                                    <div class="detail-amt discount-amt ">
                                        {{ date('l, F d, Y') }}</div>
                                </li>
                            </ul>
                            <hr>
                            <ul class="list-unstyled">
                                <li class="price-detail">
                                    <div class="detail-title detail-total">Jumlah Kuantiti Pinjaman</div>
                                    <div class="detail-amt fw-bolder">{{ $totalQuantity }}</div>
                                </li>
                            </ul>

                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="btn btn-primary w-100 btn-next place-order waves-effect waves-float waves-light">
                                    Pesan Barang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
