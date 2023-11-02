<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;

class LivingplaceExport implements FromArray //FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {   /*
        $firstItem = $this->data[0];
        return array_keys($firstItem);
        */
        
        return [
            'id',
            'division_geografica',
            'direccion',
            'barrio'
            // Agrega más encabezados según tus necesidades
        ];
        
    }

    public function array(): array
    {
        // Procesa los datos para obtener un arreglo estructurado
        $exportData = [];
        //var_dump($this->data);exit();
        foreach ($this->data as $item) {
            $exportData[] = [
                'id' => $item['livingplace']['id'],
                'division_geografica' => $item['livingplace']['division_geografica'],
                'direccion' => $item['livingplace']['direccion'],
                'barrio' => $item['livingplace']['barrio'],
                // Agrega más campos según sea necesario
            ];
        }
        return $this->data;//$exportData;
    }



}

?>