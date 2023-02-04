<?php

namespace App\Http\Controllers;

use App\Imports\TicketsImport;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TicketController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv'
        ]);

        $file = $request->file('file');

        Excel::import(new TicketsImport, $file);

        $ips = TicketsImport::$excel_ips;
        $ips = array_unique($ips);
        $ips = array_values($ips);

        Ticket::whereNotIn('ip_address', $ips)->update(['status' => 4]);

        return back()->with('message', 'Tickets imported successfully.');
    }
}
