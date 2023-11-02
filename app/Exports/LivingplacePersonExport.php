<?php

namespace App\Exports;


use App\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LivingplacePersonExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'id',
            'role',
            'name',
        ];
    }
    public function collection()
    {
         $users = DB::table('users')->select('id','role', 'name')->get();
         return $users;

    }
}