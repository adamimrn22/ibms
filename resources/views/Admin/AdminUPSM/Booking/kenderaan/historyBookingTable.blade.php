<div id="historyTable">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Booking ID</th>
                <th>Ditempah Oleh</th>
                <th>Staff ID</th>
                <th>Tarikh</th>
                <th class="text-center">Status</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $booking)
                <tr>
                    <td>
                        {{ $data->firstItem() + $index }}
                    </td>
                    <td>
                        {{ strtoupper($booking->reference) }}
                    </td>
                    <td>
                        {{ $booking->staff[0]->username }}
                    </td>
                    <td>
                        {{ $booking->staff[0]->first_name . ' ' . $booking->staff[0]->last_name }}
                    </td>
                    <td>
                        {{ $booking->created_at->format('F j, Y') }}
                    </td>
                    <td class="text-center">
                        @if ($booking->status_id == 2)
                            <span class="badge rounded-pill bg-success">
                                {{ $booking->status->name }}
                            </span>
                        @else
                            <span class="badge rounded-pill bg-danger">
                                {{ $booking->status->name }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <a class="d-inline-flex hoverPrint" target="_blank" rel=”noopener”
                            href="{{ route('upsm.BookingKenderaan.generatePDF', ['Kenderaan' => Crypt::encryptString($booking->id)]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6" width="16px">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                            </svg>

                            <span class="ms-1">
                                Print
                            </span>
                        </a>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button type="button"
                                class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light"
                                data-bs-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-more-vertical">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                </svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">


                                <a class="dropdown-item delete-paper-modal" href="javascript:void(0);"
                                    data-bs-target="#deletePaper" data-bs-toggle="modal"
                                    data-booking-id="{{ $booking->id }}">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-edit-2 me-50">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>

                                    <span>Delete</span>

                                </a>

                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        Tiada Tempahan Kereta
                    </td>

                </tr>
            @endforelse

        </tbody>
    </table>

</div>
