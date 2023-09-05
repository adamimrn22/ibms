<?php

namespace App\Pdf;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\UserPaperBookingAmount;

class UserA4AmountPDF {
    protected $year;
    protected $month;

    public function __construct(int $month, int $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function generatePDF()
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $amounts = UserPaperBookingAmount::with(['user','user.position', 'user.unit'])
            ->select('user_id', 'amount', 'default_amount')
            ->where('month', $this->month)
            ->where('year', $this->year)
            ->get();

        // Generate your PDF content here using the view or any other logic
        $view = view('pdf.userA4Amount', [
            'amounts' => $amounts
        ]);

        $dompdf->loadHtml($view->render());
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF (stream or download)
        $dompdf->render();
        return response($dompdf->output())
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', "inline; filename=Jumlah Bilangan Pinjaman A4 STAFF.pdf");
        // return $dompdf->stream('jumlah.pdf');
    }
}
