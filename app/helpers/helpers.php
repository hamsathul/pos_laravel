<?php

use App\Models\Order;

if (!function_exists('invoiceNumber')){

    // function invoiceNumber()
    // {
    //     $record = Order::latest()->first();

    //     if ($record == null or $record == "") {
    //         if (date('l', strtotime(date('Y-01-01')))) {
    //             $invoice_no = date('Y') . '-0001';
    //         }
    //     } else {
    //         $expNum = explode('-', $record->invoice_no);
    //         $innoumber = ($expNum[1] + 1);
    //         $invoice_no = $expNum[0] . '-' . sprintf('%04d', $innoumber);
    //     }

    //     return

    //     // if (! $latest) {
    //     //     return 'arm0001';
    //     // }

    //     // $string = preg_replace("/[^0-9\.]/", '', $latest->invoice_no);

    //     // return 'arm' . sprintf('%04d', $string++);
    // }


}

