<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PdfController extends Controller
{
    public function request(): Response
    {
        $pdf = Pdf::loadView('pdf/request_pdf');

        return $pdf->stream();
    }
}
