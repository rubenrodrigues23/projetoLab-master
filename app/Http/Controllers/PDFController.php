<?php

namespace App\Http\Controllers;

use App\Models\Client;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class PDFController extends Controller
{
    // public function generateInvoice($id)
    // {
    //     $data = Purchase::findOrFail($id);
    //     $pdf = PDF::loadView('invoices.invoice', $data);
    //     return $pdf->download('invoice.pdf');
    // }

    public function generateInvoicePDF($id)
    {
        $user = Auth::user();
        $client = Client::findOrFail($id);
        //dump($clients);
        $pdf = PDF::loadView('PDF', compact('client'), compact('user'));
        return $pdf->download('CyberStore.pdf');
    }
}
