<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;


class TravelInsuranceOrderInfoExport implements FromArray, WithHeadings
{
    use Exportable;

    private $model = [];
    private $heading = [
        'Full name',
        'Email',
        'Phone',
        'DOB',
        'Age',
        'Passport number',
        'Passport expire on',
        'Ins price',
        'Total vat',
        'Vat percentage',
        'Service amount',
        'Grand total',
        'Payment status',
        'Order status',
        'Flight number',
        'Flight date',
        'Return date',
        'Total days',
        'Order date',
        'Insurance type',
        'Shipping address'
    ];


    public function __construct($model)
    {

        $this->model = $model;
    }

    public function headings(): array
    {
        return $this->heading;
    }
    public function array(): array
    {
        return [
            [
                $this->model->full_name,
                $this->model->email,
                $this->model->phone,
                $this->model->dob,
                $this->model->age,
                $this->model->passport_number,
                $this->model->passport_expire_till,
                $this->model->ins_price,
                $this->model->total_vat,
                $this->model->vat_percentage,
                $this->model->service_total_amount,
                $this->model->grand_total,
                $this->model->payment_status,
                $this->model->status,
                $this->model->flight_number,
                $this->model->flight_date,
                $this->model->return_date,
                $this->model->total_date,
                $this->model->created_at,
                $this->model->travel_insurance_category_title,
                $this->model->shipping_address,
            ]
        ];
    }
}
