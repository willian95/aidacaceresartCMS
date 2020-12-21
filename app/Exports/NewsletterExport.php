<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\NewsletterUser;
use App\User;

class NewsletterExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        
        return view('excel.newsletter', [
            'newsletter' => NewsletterUser::all(), "users" => User::where("role_id", 2)->get()
        ]);

    }
}
