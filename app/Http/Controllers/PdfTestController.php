<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfTestController extends Controller
{
    public function generate()
{
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('test');
    return $pdf->stream('test.pdf'); // opens in browser
}

}
