<?php

namespace App\Exports;

use App\Models\Entreprise;
use Maatwebsite\Excel\Concerns\FromCollection;

class EntreprisesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Entreprise::all();
    }
}
