<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
            font-size: 16px
        }

        body {
            background-color: #f3f4f6;
        }

        .header-text {
            color: #333333;
        }

        h1 {
            font-size: 1.875rem;
        }

        p {
            font-size: 0.875rem;
        }

        .bg-wrapper {
            background-color: white;
            padding: 10px;
            box-shadow: 0px 10px 24px 4px rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: 0px 10px 24px 4px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0px 10px 24px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .statusFlex {
            display: flex;
            justify-content: center;
            align-items: center
        }

        .statusFlex td {
            position: relative;
            z-index: 30;
        }

        .statusFlex td:not(:last-child)::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateY(-50%);
            border-top: 1px solid #3a3a3a;
            width: 120px;
            z-index: 2
                /* Adjust the width of the divider */
        }

        .card-status-approved {
            background-color: #7772f0;
            color: white;
            border-radius: 5px;
        }

        .card-status-pending {
            background-color: #f3f4f6;
            color: #666666;
            border-radius: 5px;
        }

        .card-status-rejected {
            background-color: #dc2626;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <table class="bg-wrapper" align="center" cellspacing="0" cellpadding="0">
        <tbody align="center">
            <tr>
                <td valign="top">
                    <table cellpadding="0" cellspacing="0" class="esd-header-popover es-header" align="center">
                        <tbody>
                            <tr>
                                <td align="center">
                                    <table align="center" cellpadding="0" cellspacing="0" width="600">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table width="560" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <tr>
                                                                <td width="20"></td>
                                                                <td valign="top">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        align="right">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="125" align="left">
                                                                                    <table cellpadding="0"
                                                                                        cellspacing="0" width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align="center"
                                                                                                    style="display: none;">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left">
                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td width="560" align="center" valign="top">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        width="100%" style="margin-top: 1.25rem">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center"
                                                                                    style="color: #666666">
                                                                                    IBMS
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" class="header-text">
                                                                                    <h1>Pinjaman Alatan Tulis telah
                                                                                        berjaya!</h1>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center">
                                                                                    <p style="color: #666666">Pesanan
                                                                                        anda telah berjaya
                                                                                        dihantar. Berikut adalah
                                                                                        beberapa maklumat mengenai
                                                                                        pesanan anda
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="es-content" align="center">
                        <tbody>
                            <tr>
                                <td align="center">
                                    <table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr class="statusFlex">
                                                <td>
                                                    <table cellpadding="10" cellspacing="0">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        class="es-left" align="left">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="177" align="left">
                                                                                    <table cellpadding="0"
                                                                                        cellspacing="0" width="100%"
                                                                                        class="card-status-approved">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align="center"
                                                                                                    class="esd-block-image es-p10t es-p15r es-p15l"
                                                                                                    style="font-size: 0px; padding-top: 1rem">
                                                                                                    <img src="{{ asset('img/status_approved.png') }}"
                                                                                                        alt
                                                                                                        style="display: block;"
                                                                                                        width="30">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="center">
                                                                                                    <p>Dipesan pada </p>
                                                                                                    <p>{{ Carbon\Carbon::parse($date)->format('F j Y') }}
                                                                                                    </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table cellpadding="10" cellspacing="0" class="esdev-mso-table">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        class="es-left" align="left">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="177" align="left">
                                                                                    <table cellpadding="0"
                                                                                        cellspacing="0" width="100%"
                                                                                        class="card-status-pending">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align="center"
                                                                                                    style="font-size: 0px; padding-top: 1rem">
                                                                                                    <img src="{{ asset('img/status_uncofirmed.png') }}"
                                                                                                        alt
                                                                                                        style="display: block;"
                                                                                                        width="30">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="center">
                                                                                                    <p>Status :
                                                                                                        Pending
                                                                                                    </p>
                                                                                                    <p>Akan Dimaklumkan
                                                                                                    </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td width="560" class="esd-container-frame"
                                                                    align="center" valign="top">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center"
                                                                                    class="esd-block-text">
                                                                                    <h2 style="line-height: 150%;">
                                                                                        ORDER
                                                                                        {{ $orderID }}
                                                                                    </h2>
                                                                                    <p style="line-height: 150%;">
                                                                                        {{ $date }}</p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="left"
                                                                                    class="esd-block-text es-m-txt-c es-p20t">
                                                                                    <p style="color: #a0937d;">ITEMS
                                                                                        ORDERED</p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center"
                                                                                    class="esd-block-spacer es-p5t es-p5b"
                                                                                    style="font-size:0">
                                                                                    <table border="0"
                                                                                        width="100%" height="100%"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="border-bottom: 1px solid #a0937d; background: none; height: 1px; width: 100%; margin: 0px;">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            @foreach ($bookings as $booking)
                                                <tr>
                                                    <td align="left">
                                                        <table width="560" cellpadding="0" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="20"></td>
                                                                    <td valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            align="left">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="125" align="left">
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            width="100%">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="left">
                                                                                                        <p>
                                                                                                            {{ $booking->inventory->name }}
                                                                                                        </p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td width="20"></td>
                                                                    <td valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            align="right">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="176" align="left">
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            width="100%">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="right">
                                                                                                        <p style="color: #666666;"
                                                                                                            class="p_description">
                                                                                                            {{ $booking->quantity }}x
                                                                                                        </p>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td width="20"></td>
                                                                    <td valign="top">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                            class="es-right" align="right">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="74" align="left">
                                                                                        <table cellpadding="0"
                                                                                            cellspacing="0"
                                                                                            width="100%">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="center"
                                                                                                        style="display: none;">
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td align="left">
                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td width="560" align="center" valign="top">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center"
                                                                                    style="font-size:0">
                                                                                    <table border="0"
                                                                                        width="100%" height="100%"
                                                                                        cellpadding="0"
                                                                                        cellspacing="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="border-bottom: 1px solid #a0937d; background: none; height: 1px; width: 100%; margin: 0px;">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left">
                                                    <table width="560" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        align="left">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="466" align="left">
                                                                                    <table cellpadding="0"
                                                                                        cellspacing="0"
                                                                                        width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align="right"
                                                                                                    class="esd-block-text">
                                                                                                    <p>Jumlah
                                                                                                        Keseluruhan
                                                                                                    </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td width="20"></td>
                                                                <td class="esdev-mso-td" valign="top">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        class="es-right" align="right">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="74" align="left"
                                                                                    class="esd-container-frame">
                                                                                    <table cellpadding="0"
                                                                                        cellspacing="0"
                                                                                        width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align="right"
                                                                                                    class="esd-block-text">
                                                                                                    <p> {{ $totalQuantity }}
                                                                                                    </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td lign="left">
                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td width="560" class="esd-container-frame"
                                                                    align="center" valign="top">
                                                                    <table cellpadding="0" cellspacing="0"
                                                                        width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center"
                                                                                    class="esd-empty-container"
                                                                                    style="display: none;"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <table cellpadding="0" cellspacing="0" align="center">
                                                <tbody>
                                                    <tr>
                                                        <td align="center" bgcolor="#ffffff"
                                                            style="background-color: #ffffff;">
                                                            <table align="center" cellpadding="0" cellspacing="0"
                                                                width="600" style="background-color: transparent;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="left">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                width="100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td width="560"
                                                                                            align="left">
                                                                                            <table cellpadding="0"
                                                                                                cellspacing="0"
                                                                                                width="100%">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            align="center">
                                                                                                            <p
                                                                                                                style="font-size: 12px; color: #666666;">
                                                                                                                Anda
                                                                                                                menerima
                                                                                                                e-mel
                                                                                                                ini
                                                                                                                kerana
                                                                                                                anda
                                                                                                                telah
                                                                                                                membuat
                                                                                                                pesanan.
                                                                                                                Sila
                                                                                                                tidak
                                                                                                                membalas
                                                                                                                e-mel
                                                                                                                ini
                                                                                                                kerana
                                                                                                                ia
                                                                                                                adalah
                                                                                                                e-mel
                                                                                                                automatik.
                                                                                                                Sekiranya
                                                                                                                anda
                                                                                                                tidak
                                                                                                                membuat
                                                                                                                pesanan,
                                                                                                                sila
                                                                                                                hubungi
                                                                                                                pentadbir<br>
                                                                                                                <br>
                                                                                                                <a target="_blank"
                                                                                                                    style="font-size: 12px; color: #7772f0; "
                                                                                                                    href="http://kolejspace.edu.my/">KOLEJ
                                                                                                                    SPACE</a>
                                                                                                                | <a target="_blank"
                                                                                                                    style="font-size: 12px; color: #7772f0;">IBMS</a>
                                                                                                            </p>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
