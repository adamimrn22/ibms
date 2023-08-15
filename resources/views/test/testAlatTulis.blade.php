@extends('test.testlayout')

@section('csslink')
    <style>
        .removeBtn {
            color: #ef4444;
        }

        .removeBtn:hover {
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
@endsection

@section('section')
    <div class="card">
        <div class="p-1 d-flex justify-content-end">
            <button class="btn btn-sm btn-secondary waves-effect d-inline-flex align-items-center" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" width="20">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                <span class="ms-1">
                    ( 2 )
                </span>
            </button>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel"
        style="visibility: hidden;" aria-hidden="true">
        <div class="offcanvas-header">
            <h5 id="offcanvasEndLabel" class="offcanvas-title">Pesanan Pinjaman Alat Tulis</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <table>
                <tbody>
                    <tr>
                        <hr>
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td class="pb-3">Kertas Graf</td>
                                </tr>
                                <tr>
                                    <td align="start">Quantity</td>

                                    <td align="end" class="my-3">4x</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="removeBtn my-1" align="end">Remove</div>
                        <hr>
                    </tr>

                    <div class="my-1 removeBtn" align="end">
                        <span>Remove All</span>
                    </div>

                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light w-100">
                        Checkout
                    </button>

                </tbody>
            </table>
        </div>
    </div>
@endsection

{{-- <tr>
    <td>Tiada Barang Alat Tulis</td>
</tr> --}}
