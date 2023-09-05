<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AlatTulisStock;
use App\Pdf\UserA4AmountPDF;
use Illuminate\Http\Request;
use App\Exports\UserA4AmountExport;
use App\Http\Controllers\Controller;
use App\Pdf\AlatTulisStockPDF;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportUserA4Amount(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $exportType = $request->input('exportType');

        return $exportType === 'excel'
        ? Excel::download(new UserA4AmountExport($month, $year), 'jumlah.xlsx') // exce;
        : (new UserA4AmountPDF($month, $year))->generatePDF(); //pdf
    }

    public function exportAlatTulisAmount(Request $request)
    {
        $exportType = $request->input('exportType');
        return $exportType === 'excel'
        ? Excel::download(new AlatTulisStock, 'bilangan_semasa.xlsx') // exce;
        : (new AlatTulisStockPDF)->generatePDF(); //pdf
    }
}
