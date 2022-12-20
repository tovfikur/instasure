<?php

namespace App\Exports;

use App\Model\DeviceInsurance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdminSalesReportExport implements FromCollection, WithMapping, WithHeadings
{

    private $start_date;
    private $end_date;
    private $child_dealer_id;

    public function __construct($start_date, $end_date, $child_dealer_id)
    {
        $this->start_date           = $start_date;
        $this->end_date             = $end_date;
        $this->child_dealer_id      = $child_dealer_id;
    }

    public function headings(): array
    {
        return $this->get_headings();
    }

    public function collection()
    {
        $start_date                 = $this->start_date;
        $end_date                   = $this->end_date;
        $child_dealer_id            = $this->child_dealer_id;

        $deviceInsuranceList        = DeviceInsurance::with('childDealer.user')->whereBetween('created_at', [$start_date, $end_date])->get();
        if (!empty($child_dealer_id)) {
            $deviceInsuranceList    = DeviceInsurance::with('childDealer.user')->whereBetween('created_at', [$start_date, $end_date])->where('child_dealer_id', $child_dealer_id)->get();
        }

        return $deviceInsuranceList;
    }

    public function map($deviceInsuranceList): array
    {

        $customer = json_decode($deviceInsuranceList->customer_info);
        $device = json_decode($deviceInsuranceList->device_info);
        $insurance_types = json_decode($deviceInsuranceList->insurance_type_value);
        $insurance_types_list = '';
        foreach ($insurance_types as $type) {
            $insurance_types_list .= "{$type->parts_type}, ";
        }
        $insurance_types_list = substr($insurance_types_list, 0, strlen($insurance_types_list) - 2);

        return [

            ucwords($deviceInsuranceList->childDealer->com_org_inst_name),
            $deviceInsuranceList->childDealer->user->phone,
            $deviceInsuranceList->childDealer->user->email ?? "not set",
            $deviceInsuranceList->policy_number,
            date_format_custom($deviceInsuranceList->created_at),
            dateFormat(insExpireDate($deviceInsuranceList)),
            dateFormat(claimWillActiveDate($deviceInsuranceList)),
            $customer->customer_name,
            $customer->customer_phone,
            ucwords($customer->inc_exc_type) . '-' . $customer->number,
            $device->brand_name,
            $device->model_name,
            $device->imei_one,
            $device->device_price,
            $deviceInsuranceList->grand_total,
            $insurance_types_list

        ];
    }


    /**
     * Get parts heading
     *
     * @return array
     */
    private function get_headings()
    {
        $headings = [
            'Dealer Name',
            'Dealer Phone',
            'Dealer Email',
            'Policy ID',
            'Activation Date',
            'Valid Upto',
            'Cooling Period',
            'Customer Name',
            'Phone',
            'NID or Passport',
            'Brand Name',
            'Model Name',
            'IMEI 1',
            'Insured Amount',
            'Paid',
            'Insurance Type',
        ];

        return $headings;
    }
}
