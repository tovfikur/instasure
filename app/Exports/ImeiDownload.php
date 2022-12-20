<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;


class ImeiDownload implements FromArray, WithHeadings
{
    use Exportable;

    private $sample_data = [];
    private $heading = [];


    public function __construct($sample_data,$heading)
    {

        $this->sample_data = $sample_data;
        $this->heading = $heading;
    }

    public function headings(): array
    {
        return $this->heading;
    }
    public function array(): array
    {
        return [
            $this->sample_data
        ];
    }
}
