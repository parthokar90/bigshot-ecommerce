<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DispatchExcel implements FromView
{
     private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('admin.order.dispatch_excel_data', [
            'data' => $this->data
        ]);
    }
}
