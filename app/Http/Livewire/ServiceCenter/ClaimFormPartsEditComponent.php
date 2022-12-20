<?php

namespace App\Http\Livewire\ServiceCenter;

use App\Model\DeviceClaimedPart;
use App\Model\DeviceInsuranceDetails;
use App\Model\Part;
use Livewire\Component;
use Brian2694\Toastr\Facades\Toastr;
use Livewire\WithFileUploads;
use App\Services\SmsService;

class ClaimFormPartsEditComponent extends Component
{
    use WithFileUploads;
    public $deviceInsurance;
    public $deviceInsuranceDetails;
    protected $deviceInfo;
    public $brand_id;
    public $brand_name;
    public $model_id;
    public $model_name;
    public $selected_parts_list = [];
    public $parent_dealer_id;
    public $isValidated = false;
    public $totalAmount = 0;
    public $deviceInsuranceDetails_id;
    public $images;
    public $protection_times_for;
    public $claim_amount;
    public $insuranceTypeError = false;
    public $serviceCenterDetails;
    public $parts;
    public $new_parts_name;
    public $new_parts_name_error = false;
    public $selectedPartsId;
    public $note = '';
    public $partsError = false;
    public $status_note = '';
    public $deviceClaim;


    /**
     * Component mount which sets initial values
     */
    public function mount($deviceInsurance, $deviceInsuranceDetails, $deviceInfo, $deviceClaim, $deviceClaimedParts)
    {

        $this->deviceInsurance = $deviceInsurance;
        $this->deviceInsuranceDetails = $deviceInsuranceDetails;
        $this->deviceInfo = $deviceInfo;
        $this->brand_id = $deviceInfo->brand_id;
        $this->brand_name = $deviceInfo->brand_name;
        $this->model_id = $deviceInfo->device_model_id;
        $this->model_name = $deviceInfo->model_name;
        $this->selected_parts_list = $deviceClaimedParts;
        $this->parent_dealer_id = $deviceInsurance->parent_dealer_id;
        $this->new_parts_name = '';
        $this->totalAmount = $deviceClaim->total_amount;
        $this->deviceClaim = $deviceClaim;
        $this->status_note = $deviceClaim->status_note;
        $this->parts = Part::where(['brand_id' => $deviceInfo->brand_id, 'model_id' =>  $deviceInfo->device_model_id, 'status' => 1])->get();

        ## Find parts from first brand first model ##
        if (count($this->parts)) {
            $this->selectedPartsId = strtolower($this->parts[0]->parts_name);
        }

        // dd($deviceInsuranceDetails);

        // if (count($deviceInsuranceDetails)) {
        //     $this->deviceInsuranceDetails_id = count($deviceInsuranceDetails) ?  $deviceInsuranceDetails[0]->id : null;
        //     if ($deviceInsuranceDetails[0]->parts_type == 'Screen Protection') {
        //         $this->protection_times_for = $deviceInsuranceDetails[0]->protection_times_for;
        //     }
        // }

        if (count($deviceInsuranceDetails->toArray())) {
            // var_dump($deviceInsuranceDetails, 'ok');
            $currentDeviceInsuranceType = array_filter($deviceInsuranceDetails->toArray(), function ($item) {
                return $item['parts_type'] == $this->deviceClaim->claim_on;
            });
            // dd($currentDeviceInsuranceType);
            foreach ($currentDeviceInsuranceType as $item) {
                $this->deviceInsuranceDetails_id = $item['id'];
            }
        }


        $this->claim_amount = $this->deviceClaim->device_value - $this->totalAmount;
    }

    /**
     * Update device insuracen details
     */
    public function updatedDeviceInsuranceDetailsId()
    {

        foreach ($this->deviceInsuranceDetails as $item) {
            if ($item->id == $this->deviceInsuranceDetails_id) {
                if ($item->parts_type == 'Screen Protection') {
                    $this->protection_times_for = $item->protection_times_for;
                }
            }
        }
        $this->claim_amount = $this->deviceClaim->device_value - $this->totalAmount;
    }

    /**
     * Render to display on view
     */
    public function render()
    {
        // dd($this->selected_parts_list);
        return view('livewire.service-center.claim-form-parts-edit-component');
    }
    /**
     * Add new parts item to list
     */

    public function addNew()
    {

        $this->parts->filter(function ($singleParts) {
            if ($this->selectedPartsId == strtolower($singleParts->parts_name)) {
                if (!array_key_exists($this->selectedPartsId, $this->selected_parts_list)) {
                    $this->selected_parts_list[$this->selectedPartsId] = [
                        'parts_name' => $singleParts->parts_name,
                        'parts_price' => $singleParts->parts_price,
                        'parts_identity_number' => '',
                        'parts_details' => '',
                        'product_id' => $this->selectedPartsId
                    ];
                } else {
                    $this->dispatchBrowserEvent('item_exist');
                }
            }
        });
        $this->calculateTotalAmount();
        $this->claim_amount = $this->deviceClaim->device_value - $this->totalAmount;
    }

    /**
     * Remove item from parts selected list
     */

    public function removeItem($id)
    {
        $this->selected_parts_list = array_filter($this->selected_parts_list, function ($index) use ($id) {
            return $index != $id;
        }, ARRAY_FILTER_USE_KEY);
        $this->calculateTotalAmount();
        $this->claim_amount = $this->deviceClaim->device_value - $this->totalAmount;
    }
    /**
     * Calculate total amount
     */

    protected function calculateTotalAmount()
    {
        $this->totalAmount =  array_sum(array_column($this->selected_parts_list, 'parts_price'));
    }


    /**
     * claimSubmit after adding parts informations
     *
     */

    public function claimSubmit()
    {
        if (!count($this->selected_parts_list) || !count($this->deviceInsuranceDetails)) {
            $this->partsError = !count($this->selected_parts_list) ? "Please add parts" : false;
            return;
        } elseif ($this->deviceClaim->status_admin == 'approved') {
            Toastr::error('Claim can not be udpated');
            return redirect()->route('serviceCenter.insurance-claim.details', $this->deviceClaim->id);
        } else {
            $this->partsError = false;
        }

        $deviceInsurance = $this->deviceInsurance;
        $customerPhone = json_decode($deviceInsurance->customer_info)->customer_phone;
        $deviceClaim = $this->deviceClaim;
        $details = DeviceInsuranceDetails::find($this->deviceInsuranceDetails_id);

        if ($deviceInsurance->customer_will_pay_charge == 1) {
            if ($this->totalAmount > $deviceClaim->device_value && $deviceInsurance->claimable_amount != 0) {

                $deviceClaim->amount_will_pay_ins_provider = $deviceClaim->device_value - userWillPay($deviceClaim->device_value);
                $extra_amount_for_user = $this->totalAmount -  $deviceClaim->device_value;
                $deviceClaim->user_will_pay = $extra_amount_for_user  + userWillPay($deviceClaim->device_value);
                $deviceInsurance->claimable_amount = 0;
            }
            if ($this->totalAmount <= $deviceClaim->device_value && $deviceInsurance->claimable_amount != 0) {
                $deviceClaim->amount_will_pay_ins_provider = $this->totalAmount - userWillPay($this->totalAmount);
                $deviceClaim->user_will_pay = userWillPay($this->totalAmount);
                $deviceInsurance->claimable_amount =  $deviceClaim->device_value - $this->totalAmount;
            }
        } else {
            $deviceClaim->amount_will_pay_ins_provider = $this->totalAmount;
            $deviceClaim->user_will_pay = 0;
        }

        $deviceInsurance->claimed_amount = $this->totalAmount;

        ## update device insurance
        $deviceInsurance->save();

        ## Update insurance protection type
        if ($details->parts_type == 'Screen Protection') {
            if ($details->protection_times_for > 0) {
                $details->protection_times_for = $details->protection_times_for - 1;
                $details->save();
                if ($details->protection_times_for == 0) {
                    $details->claim_status = 0;
                    $details->save();
                }
            }
        }


        ## Insert Device Claimed Parts
        if (count($this->selected_parts_list)) {
            ## Delete previous parts
            $deviceClaim->device_claimed_parts()->delete();
            foreach ($this->selected_parts_list as $item) {
                $deviceClaimParts = new DeviceClaimedPart();
                $deviceClaimParts->device_claim_id = $deviceClaim->id;
                $deviceClaimParts->device_insurance_id = $deviceInsurance->id;
                $deviceClaimParts->parts_name = $item['parts_name'];
                $deviceClaimParts->parts_identity_number = $item['parts_identity_number'];
                $deviceClaimParts->parts_price = $item['parts_price'];
                $deviceClaimParts->parts_details = $item['parts_details'];
                $deviceClaimParts->status = 'pending';
                $deviceClaimParts->save();
            }
        }

        ## Upload damaged images
        if (isset($this->images)) {

            $this->validate([
                'images.*' => 'image|max:1024', // 1MB Max
            ]);
            $attachments = [];

            foreach ($this->images as $image) {
                if (isset($image)) {
                    $imagename = imageUpload($image, '/uploads/claim/document/', 0);
                    array_push($attachments, $imagename);
                }
            }

            $deviceClaim->document = json_encode($attachments);
        }

        $deviceClaim->total_amount = $this->totalAmount;
        $deviceClaim->status = 'pending';
        if ($this->status_note) {
            $deviceClaim->status_note = $this->status_note;
        }
        $deviceClaim->claim_on = $details->parts_type;
        ## Update device claim
        $deviceClaim->save();

        ## Send sms on mobile
        $smsResponse = SmsService::send_sms($customerPhone, env('SMS_API_CLAIM_UPDATED'));
        Toastr::success('Claim Update Successfully. Please wait until approval!');
        return redirect()->route('serviceCenter.insurance-claim.details', $deviceClaim->id);
    }
}
