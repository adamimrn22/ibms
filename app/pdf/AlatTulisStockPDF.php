<?php

namespace App\Pdf;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\UkwInventory;
use Illuminate\Support\Facades\DB;

class AlatTulisStockPDF {

    public function generatePDF()
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $stocks = UkwInventory::with('status', 'subcategory')->get();

        // Generate your PDF content here using the view or any other logic
        $view = view('pdf.bilangan-semasa', [
            'stocks' => $stocks
        ]);

        $dompdf->loadHtml($view->render());
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF (stream or download)
        $dompdf->render();

        return response($dompdf->output())
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', "inline; filename=bilangan_semasa.pdf");
        // return $dompdf->stream('jumlah.pdf');
    }
}
