<?php

namespace App\Exports;

use App\Payment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('excel.sales', [
            'payments' => Payment::with("user", "user.country", "guestUser", "guestUser.country")
            ->with(['productPurchases.productFormatSize' => function ($q) {
                $q->withTrashed();
                $q->with(['product' => function ($k) {
                    $k->withTrashed();
                }]);
                $q->with(['size' => function ($k) {
                    $k->withTrashed();
                }]);
            }])->get()
        ]);
    }
}
