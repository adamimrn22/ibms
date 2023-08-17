<!DOCTYPE html>
<html lang="en" style="padding: 0;margin: 0;box-sizing: border-box;">

<head style="padding: 0;margin: 0;box-sizing: border-box;">
    <meta charset="UTF-8" style="padding: 0;margin: 0;box-sizing: border-box;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"
        style="padding: 0;margin: 0;box-sizing: border-box;">

    <title style="padding: 0;margin: 0;box-sizing: border-box;">Document</title>

</head>

<body
    style="padding: 0;margin: 0;box-sizing: border-box;background-color: #F3F4F6;font-family: Helvetica, Arial, sans-serif;">
    <div style="opacity: 0;padding: 0;margin: 0;box-sizing: border-box;">{{ $randomness }}</div>
    <div style="padding: 0;margin: 0;box-sizing: border-box;">
        <table align="center" height="100" width="100%" class="containerSpacer"
            style="padding: auto;margin: 0;box-sizing: border-box;background: #7772F0;">
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
                <tr align="left" style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td style="padding: 0;margin: 0;box-sizing: border-box;">
                        <h2 class="font-normal text-gray my-1"
                            style="padding: 0;margin: 1rem 0;box-sizing: border-box;color: #727580;font-weight: 400;">
                            <b style="padding: 0;margin: 0;box-sizing: border-box;">
                                Terdapat Pesanan Baharu!
                            </b>
                        </h2>
                    </td>
                </tr>
            </table>

            <table class="my-1 text-gray" style="padding: 0;margin: 1rem 0;box-sizing: border-box;color: #727580;">
                <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td style="padding: 0;margin: 0;box-sizing: border-box;">Kepada, ADMIN UPSM</td>
                </tr>
            </table>
            <table style="margin-bottom: 1.5rem;padding: 0;margin: 0;box-sizing: border-box;" width="100%">
                <tr class="text-gray" style="padding: 0;margin: 0;box-sizing: border-box;color: #727580;">
                    <td style="padding: 0;margin: 0;box-sizing: border-box;">
                        Terdapat pesanan baharu yang dibuat oleh staff. <br
                            style="padding: 0;margin: 0;box-sizing: border-box;"> Berikut adalah beberapa maklumat
                        mengenai pesanan tersebut
                    </td>
                </tr>
            </table>

            <table width="100%" class="my-1" style="padding: 0;margin: 1rem 0;box-sizing: border-box;">
                <tr align="left" style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td class="text-gray" style="padding: 0;margin: 0;box-sizing: border-box;color: #727580;">
                        <span style="padding: 0;margin: 0;box-sizing: border-box;">
                            TEMPAHAN ID:
                            <b style="padding: 0;margin: 0;box-sizing: border-box;">
                                {{ $orderID }}
                            </b>
                        </span>
                    </td>
                    <td align="right" class="text-gray"
                        style="padding: 0;margin: 0;box-sizing: border-box;color: #727580;">
                        <b style="padding: 0;margin: 0;box-sizing: border-box;">
                            TARIKH: {{ $date }}
                        </b>
                    </td>
                </tr>

                <tr align="left" style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td class="text-gray" style="padding: 0;margin: 0;box-sizing: border-box;color: #727580;">
                        STAFF ID: <b style="padding: 0;margin: 0;box-sizing: border-box;">{{ $user->username }}</b>
                    </td>
                </tr>
                <tr align="left" style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td class="text-gray" style="padding: 0;margin: 0;box-sizing: border-box;color: #727580;">
                        NAMA STAFF: <b
                            style="padding: 0;margin: 0;box-sizing: border-box;">{{ $user->first_name . ' ' . $user->last_name }}</b>
                    </td>
                </tr>
                <tr align="left" style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td class="text-gray" style="padding: 0;margin: 0;box-sizing: border-box;color: #727580;">
                        UNIT: <b style="padding: 0;margin: 0;box-sizing: border-box;">{{ $user->unit->name }}</b>
                    </td>
                </tr>
                <tr align="left" style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td class="text-gray" style="padding: 0;margin: 0;box-sizing: border-box;color: #727580;">
                        JAWATAN: <b style="padding: 0;margin: 0;box-sizing: border-box;">{{ $user->position->name }}</b>
                    </td>
                </tr>
            </table>

            <h4 style="color: #727580;text-transform: uppercase;padding: 0;margin: 0;box-sizing: border-box;">Butir
                Tempahan Kereta :</h4>

            <table border="1" cellspacing="0" width="100%"
                style="border-collapse: collapse;border: 2px solid gray;margin: 15px 0;padding: 0;box-sizing: border-box;">
                <thead style="padding: 0;margin: 0;box-sizing: border-box;">
                    <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                        <th scope="col" colspan="5"
                            style="padding: 10px;text-align: center;color: #727580;font-family: Arial, Helvetica, sans-serif !important;margin: 0;box-sizing: border-box;">
                            BUTIR TEMPAHAN
                        </th>
                    </tr>
                </thead>
                <tbody style="padding: 0;margin: 0;box-sizing: border-box;">
                    <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                        <th width="20%"
                            style="padding: 3px;text-align: center;color: #727580;font-family: Arial, Helvetica, sans-serif !important;margin: 0;box-sizing: border-box;">
                            Tarikh Pergi:
                        </th>
                        <td
                            style="padding: 8px;text-align: center;color: #727580;font-family: Arial, Helvetica, sans-serif !important;margin: 0;box-sizing: border-box;">
                            {{ $booking->dateGo }}
                        </td>
                    </tr>
                    <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                        <th
                            style="padding: 3px;text-align: center;color: #727580;font-family: Arial, Helvetica, sans-serif !important;margin: 0;box-sizing: border-box;">
                            Tarikh Balik:
                        </th>
                        <td
                            style="padding: 8px;text-align: center;color: #727580;font-family: Arial, Helvetica, sans-serif !important;margin: 0;box-sizing: border-box;">
                            {{ $booking->dateReturn }}
                        </td>
                    </tr>
                    <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                        <th
                            style="padding: 3px;text-align: center;color: #727580;font-family: Arial, Helvetica, sans-serif !important;margin: 0;box-sizing: border-box;">
                            Waktu Pergi:
                        </th>
                        <td
                            style="padding: 8px;text-align: center;color: #727580;font-family: Arial, Helvetica, sans-serif !important;margin: 0;box-sizing: border-box;">
                            {{ $booking->timeGo }}
                        </td>
                    </tr>
                    <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                        <th
                            style="padding: 3px;text-align: center;color: #727580;font-family: Arial, Helvetica, sans-serif !important;margin: 0;box-sizing: border-box;">
                            Waktu Balik:
                        </th>
                        <td
                            style="padding: 8px;text-align: center;color: #727580;font-family: Arial, Helvetica, sans-serif !important;margin: 0;box-sizing: border-box;">
                            {{ $booking->timeReturn }}
                        </td>
                    </tr>
                    <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                        <th
                            style="padding: 3px;text-align: center;color: #727580;font-family: Arial, Helvetica, sans-serif !important;margin: 0;box-sizing: border-box;">
                            Destinasi:
                        </th>
                        <td
                            style="padding: 8px;text-align: center;color: #727580;font-family: Arial, Helvetica, sans-serif !important;margin: 0;box-sizing: border-box;">
                            {{ $booking->destination }}
                        </td>
                    </tr>
                    <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                        <th
                            style="padding: 3px;text-align: center;color: #727580;font-family: Arial, Helvetica, sans-serif !important;margin: 0;box-sizing: border-box;">
                            Tujuan:
                        </th>
                        <td
                            style="padding: 8px;text-align: center;color: #727580;font-family: Arial, Helvetica, sans-serif !important;margin: 0;box-sizing: border-box;">
                            {{ $booking->objective }}
                        </td>
                    </tr>
                </tbody>
            </table>


            <table width="100%" style="padding: 0;margin: 0;box-sizing: border-box;">
                <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                    <td align="right" style="padding: 0;margin: 0;box-sizing: border-box;">
                        <a href="{{ route('upsm.BookingKenderaan.edit', ['Kenderaan' => Crypt::encryptString($booking->id)]) }}"
                            class="btn btn-primary"
                            style="padding: 10px 20px;margin: 0;box-sizing: border-box;display: inline-block;font-size: 16px;text-align: center;text-decoration: none;border-radius: 5px;cursor: pointer;color: #fff;background-color: #7772F0;">
                            EDIT PERMOHONAN
                        </a>
                    </td>
                </tr>
            </table>

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

        <table align="center" height="100" width="100%" class="containerSpacer"
            style="padding: auto;margin: 0;box-sizing: border-box;background: #7772F0;">
            <tr style="padding: 0;margin: 0;box-sizing: border-box;">
                <td style="padding: 0;margin: 0;box-sizing: border-box;"></td>
                <td style="padding: 0;margin: 0;box-sizing: border-box;"></td>
                <td style="padding: 0;margin: 0;box-sizing: border-box;"></td>
            </tr>
        </table>

    </div>

    <div style="opacity: 0;padding: 0;margin: 0;box-sizing: border-box;">{{ $randomness }}</div>
</body>

</html>
