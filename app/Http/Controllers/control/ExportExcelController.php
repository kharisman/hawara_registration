<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exports\QRCustomerExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    public function export() 
    {
        return Excel::download(new QRCustomerExport, 'customer.xlsx');
    }

    /*public function import() 
    {
        Excel::import(new UsersImport,request()->file('file'));
             
        return back();
    }*/
}
