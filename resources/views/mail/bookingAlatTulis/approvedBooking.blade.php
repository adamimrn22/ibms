<!DOCTYPE html>
<html lang="en" style="padding: 0;margin: 0;box-sizing: border-box;">

<head style="padding: 0;margin: 0;box-sizing: border-box;">
    <meta charset="UTF-8" style="padding: 0;margin: 0;box-sizing: border-box;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"
        style="padding: 0;margin: 0;box-sizing: border-box;">

    <title style="padding: 0;margin: 0;box-sizing: border-box;">Document</title>

</head>

<body
    style="padding: 0;margin: 0;box-sizing: border-box;background-color: white ;font-family: Arial, Helvetica, sans-serif;">
    <div style="opacity: 0;">{{ $randomness }}</div>
    <div style="padding: 0;box-sizing: border-box">
        <table align="center"
            style="border-radius: 5px 5px 0 0;padding: auto;margin: 0;box-sizing: border-box;background: #7772F0;"
            height="100" width="100%" class="containerSpacer">
            <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                <td style="padding: 0;margin: 0;box-sizing: border-box;"></td>
                <td style="padding: 0;margin: 0;box-sizing: border-box;"></td>
                <td style="padding: 0;margin: 0;box-sizing: border-box;"></td>
            </tr>
        </table>

        <div class="section" style="padding: 1rem;margin: 0;box-sizing: border-box;">

            <table width="100%" style="padding: 0;margin: 0;box-sizing: border-box;">
                <tr align="center" style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td style="padding: 0;margin: 0;box-sizing: border-box;">
                        <h1 class="title-header"
                            style="padding: 0;margin: 0;box-sizing: border-box;font-weight: 800;color: #7772F0;">
                            IBMS
                        </h1>
                    </td>
                </tr>
            </table>
            <hr style="padding: 0;margin: 0.25rem 0;box-sizing: border-box;border: solid 1px #7772F0;">
            <table width="100%" style="padding: 0;margin: 0;box-sizing: border-box;">
                <tr align="center" style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td style="padding: 0;margin: 0;box-sizing: border-box;">
                        <h2 class="font-normal text-gray my-1"
                            style="padding: 0;margin: 1rem 0;box-sizing: border-box;color: #727580;font-weight: 400;">
                            <b style="padding: 0;margin: 0;box-sizing: border-box;">
                                Pinjaman Alatan Tulis telah diluluskan!
                            </b>
                        </h2>
                    </td>
                </tr>
            </table>

            <table class="my-1 text-gray" style="padding: 0;margin: 1rem 0;box-sizing: border-box;color: #727580;">
                <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td style="padding: 0;margin: 0;box-sizing: border-box;">Kepada,
                        {{ $user->first_name . ' ' . $user->last_name }}</td>
                </tr>
            </table>
            <table style="margin-bottom: 1.5rem;padding: 0;margin: 0;box-sizing: border-box;">
                <tr class="text-gray" style="padding: 0;margin: 0;box-sizing: border-box;color: #727580;">
                    <td style="padding: 0;margin: 0;box-sizing: border-box;">
                        Pesanan anda telah diluluskan. Sila ambil barang yang telah dimohon </td>
                </tr>

            </table>

            <table width="100%" class="my-1" style="padding: 0;margin: 1rem 0;box-sizing: border-box;">
                <tr align="left" style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td class="text-gray" style="padding: 0;margin: 0;box-sizing: border-box;color: #727580;">
                        <span style="padding: 0;margin: 0;box-sizing: border-box;">
                            ORDER:
                            <b style="padding: 0;margin: 0;box-sizing: border-box;">
                                {{ $orderID }}
                            </b>
                        </span>
                    </td>

                </tr>
                <tr align="left" style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td class="text-gray" style="padding: 0;margin: 0;box-sizing: border-box;color: #727580;">
                        {{ $approvedDate }}
                    </td>
                </tr>
            </table>

            <table border="1" cellspacing="0" width="50%"
                style="border-collapse: collapse; border: 2px solid gray; margin: 15px 0;">
                <thead>
                    <tr>
                        <th
                            style="padding: 3px; text-align: center; color: #727580; font-family: Arial, Helvetica, sans-serif !important;">
                            Dipesan Pada</th>
                        <th
                            style="padding: 3px; text-align: center; color: #727580; font-family: Arial, Helvetica, sans-serif !important;">
                            Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td
                            style="padding: 8px; text-align: center; color: #727580; font-family: Arial, Helvetica, sans-serif !important;">
                            <p>{{ Carbon\Carbon::parse($bookDate)->format('F j Y') }}
                        </td>
                        <td
                            style="padding: 8px; text-align: center; color: #727580; font-family: Arial, Helvetica, sans-serif !important;">
                            <p> APPROVED ( {{ Carbon\Carbon::parse($approvedDate)->format('F j Y') }} )
                        </td>
                    </tr>
                </tbody>
            </table>

            <table border="1" cellspacing="0" width="100%"
                style="border-collapse: collapse;border: 2px solid gray;padding: 0;margin: 0;box-sizing: border-box;">
                <thead style="padding: 0;margin: 0;box-sizing: border-box;">
                    <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                        <th style="padding: 8px;text-align: left;color: #727580;margin: 0;box-sizing: border-box;">
                            PESANAN BARANG</th>
                        <th style="padding: 8px;text-align: right;color: #727580;margin: 0;box-sizing: border-box;">
                            KUANTITI YANG DIMOHON</th>
                        <th style="padding: 8px;text-align: right;color: #727580;margin: 0;box-sizing: border-box;">
                            KUANTITI YANG DILULUSKAN</th>
                        <th style="padding: 8px;text-align: center;color: #727580;margin: 0;box-sizing: border-box;">
                            STATUS</th>
                        <th style="padding: 8px;text-align: center;color: #727580;margin: 0;box-sizing: border-box;">
                            Catatan</th>
                    </tr>
                </thead>
                <tbody style="padding: 0;margin: 0;box-sizing: border-box;">
                    @foreach ($booking->inventories as $inventory)
                        <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                            <td style="padding: 8px;text-align: left;color: #727580;margin: 0;box-sizing: border-box;">
                                {{ $inventory->name }}
                            </td>
                            <td style="padding: 8px;text-align: right;color: #727580;margin: 0;box-sizing: border-box;">
                                {{ $inventory->pivot->quantity }}x
                            </td>
                            <td style="padding: 8px;text-align: right;color: #727580;margin: 0;box-sizing: border-box;">
                                {{ $inventory->pivot->approved_quantity }}x
                            </td>
                            <td
                                style="padding: 8px;text-align: center;color: #727580;margin: 0;box-sizing: border-box;">
                                @php
                                    $statusId = $inventory->pivot->status_id;
                                    $statusName = \App\Models\BookingStatus::find($statusId)->name ?? 'N/A';
                                @endphp
                                {{ $statusName }}
                            </td>
                            <td style="padding: 8px;text-align: right;color: #727580;margin: 0;box-sizing: border-box;">
                                {{ $inventory->pivot->remarkNotes }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p style="text-align: end;padding: 0;margin: 1rem 0;box-sizing: border-box;color: #727580;"
                class="text-gray my-1">Jumlah Kesemua Barang yang diluluskan: <span
                    style="padding: 0;margin: 0;box-sizing: border-box;">
                    {{ $totalQuantity }}
                </span>
            </p>

            <table class="my-1 text-gray" style="padding: 0;margin: 1rem 0;box-sizing: border-box;color: #727580;">
                <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td style="padding: 0;margin: 0;box-sizing: border-box;">Daripada,</td>
                </tr>
                <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td style="padding: 0;margin: 0;box-sizing: border-box;">IBMS Support</td>
                </tr>
            </table>

            <div class="thin-line"
                style="padding: 0;margin: 10px 0;box-sizing: border-box;height: 1px;background-color: #727580;"></div>
            <table width="100%" style="padding: 0;margin: 0;box-sizing: border-box;">
                <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                    <p class="text-gray"
                        style="font-size: 0.75rem;text-align: center;padding: 0;margin: 0;box-sizing: border-box;color: #727580;">
                        Anda menerima e-mel ini kerana anda telah membuat pesanan. Mohon untuk tidak membalas e-mel
                        ini kerana
                        ia
                        adalah e-mel automatik. Sekiranya anda tidak membuat pesanan, sila hubungi pentadbir.
                    </p>
                </tr>
            </table>

            <table width="100%" style="padding: 0;margin: 0;box-sizing: border-box;">
                <tr align="center" style="padding: 0;margin: 0;box-sizing: border-box;">
                    <p class="text-gray my-1"
                        style="font-size: 0.75rem;text-align: center;padding: 0;margin: 1rem 0;box-sizing: border-box;color: #727580;">
                        KOLEJSPACE | IBMS
                    </p>
                </tr>
            </table>

        </div>

        <table align="center" style="padding: auto;margin: 0;box-sizing: border-box;background: #7772F0;"
            height="100" width="100%" class="containerSpacer">
            <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                <td style="padding: 0;margin: 0;box-sizing: border-box;"></td>
                <td style="padding: 0;margin: 0;box-sizing: border-box;"></td>
                <td style="padding: 0;margin: 0;box-sizing: border-box;"></td>
            </tr>
        </table>

    </div>

    <div style="opacity: 0;">{{ $randomness }}</div>
</body>

</html>
