<?php

namespace App\Http\Livewire\ServiceCenter;

use App\Model\DeviceClaim;
use App\Model\DeviceClaimedPart;
use App\Model\DeviceInsurance;
use App\Model\DeviceInsuranceDetails;
use App\Model\Part;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Model\ServiceCenterDetails;
use Brian2694\Toastr\Facades\Toastr;
use Livewire\WithFileUploads;
use App\Helpers\UserInfo;
use App\Model\Brand;
use PhpParser\Node\Expr\FuncCall;


class _ClaimFormPartsAddComponent extends Component
{
    use WithFileUploads;
    public $insurance;
    public $details;
    public $deviceInfo;
    public $brand_id;
    public $brand_name;
    public $model_id;
    public $model_name;
    public $selected_parts_list;
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

    /**
     * Send mobile sms
     *
     */

    public function new_parts_request_to_admin()
    {
        if (!$this->new_parts_name) {
            $this->new_parts_name_error = 'Required';
            return;
        }
        $data['brand_id']           = $this->brand_id;
        $data['model_id']           = $this->model_id;
        $data['user_id']            = Auth::id();
        $data['parent_dealer_id']   = $this->parent_dealer_id;
        $data['parts_name']         = $this->new_parts_name;
        $data['parts_price']        = 0;
        $data['status']             = 0;
        $data['status']             = 0;
        $data['note']               = $this->note;
        try {
            Part::create($data);
            $this->new_parts_name_error = 'Successfull';
        } catch (\Throwable $th) {
            $this->new_parts_name_error = 'Query Error';
        }
    }

    /**
     * Component mount which sets initial values
     */
    public function mount($insurance, $details, $deviceInfo)
    {
        // dd($details);
        $this->insurance = $insurance;
        $this->details = $details;
        $this->deviceInfo = $deviceInfo;
        $this->brand_id = $deviceInfo['brand_id'];
        $this->brand_name = $deviceInfo['brand_name'];
        $this->model_id = $deviceInfo['device_model_id'];
        $this->model_name = $deviceInfo['model_name'];
        $this->selected_parts_list = [];
        $this->parent_dealer_id = $insurance->parent_dealer_id;
        $this->new_parts_name = '';


        $this->parts = Part::where(['brand_id' => $deviceInfo['brand_id'], 'model_id' =>  $deviceInfo['device_model_id'], 'status' => 1])->get();

        ## Find parts from first brand first model ##
        if (count($this->parts)) {
            $this->selectedPartsId = $this->parts[0]->id;
        }

        if (count($details)) {
            $this->deviceInsuranceDetails_id = count($details) ?  $details[0]->id : null;
            if ($details[0]->parts_type == 'Screen Protection') {
                $this->protection_times_for = $details[0]->protection_times_for;
            } else {
                $this->claim_amount = $details[0]->claim_amount;
            }
        }
    }


    public function updatedDeviceInsuranceDetailsId()
    {

        foreach ($this->details as $item) {
            if ($item->id == $this->deviceInsuranceDetails_id) {
                if ($item->parts_type == 'Screen Protection') {
                    $this->protection_times_for = $item->protection_times_for;
                    $this->claim_amount = null;
                } else {
                    $this->claim_amount = $item->claim_amount;
                    $this->protection_times_for = null;
                }
            }
        }
    }

    /**
     * Render to display on view
     */
    public function render()
    {

        return view('livewire.service-center.claim-form-parts-add-component');
    }
    /**
     * Add new parts item to list
     */

    public function addNew()
    {

        $this->parts->filter(function ($singleParts) {
            if ($this->selectedPartsId == $singleParts->id) {
                $this->selected_parts_list[] = [
                    'parts_name' => $singleParts->parts_name,
                    'parts_price' => $singleParts->parts_price,
                    'parts_identity_number' => '',
                    'parts_details' => '',
                ];
            }
        });
        $this->calculateTotalAmount();
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
        if (!count($this->selected_parts_list) || !count($this->details)) {
            $this->partsError = !count($this->selected_parts_list) ? "Please add parts" : false;
            return;
        } else {
            $this->partsError = false;
        }

        $serviceCenter = ServiceCenterDetails::where('user_id', Auth::id())->first();
        $deviceInsurance = DeviceInsurance::find($this->insurance->id);
        $customerPhone = json_decode($deviceInsurance->customer_info)->customer_phone;
        $deviceClaim = new DeviceClaim();
        $details = DeviceInsuranceDetails::find($this->deviceInsuranceDetails_id);


        // dd($deviceInsurance);

        $deviceClaim->user_id = $deviceInsurance->user_id;
        $deviceClaim->device_insurance_id = $this->insurance->id;
        $deviceClaim->service_center_id = $serviceCenter->id;
        if ($deviceInsurance->customer_will_pay_charge == 1) {
            $deviceClaim->amount_will_pay_ins_provider = $this->totalAmount - userWillPay($this->totalAmount);
            $deviceClaim->user_will_pay = userWillPay($this->totalAmount);
        } else {
            $deviceClaim->amount_will_pay_ins_provider = $this->totalAmount;
            $deviceClaim->user_will_pay = 0;
        }

        $deviceClaim->device_value = $this->deviceInfo['device_price'];
        $deviceClaim->total_amount = $this->totalAmount;
        $deviceClaim->status = 'pending';
        $deviceClaim->status_note = $this->status_note;
        $deviceClaim->claim_id = 'CL-' . mt_rand(111111, 999999);
        $attachments = array();

        if (isset($this->images)) {
            $this->validate([
                'images.*' => 'image|max:1024', // 1MB Max
            ]);

            foreach ($this->images as $image) {
                if (isset($image)) {
                    $imagename = imageUpload($image, '/uploads/claim/document/', 0);
                    array_push($attachments, $imagename);
                }
            }
            $deviceClaim->document = json_encode($attachments);
        }



        if ($deviceClaim->save()) {
            if (count($this->selected_parts_list)) {
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
        }


        if ($details->parts_type == 'Screen Protection') {
            if ($details->protection_times_for > 0) {
                $details->protection_times_for = $details->protection_times_for - 1;
                $details->save();
                if ($details->protection_times_for == 0) {
                    $details->claim_status = 0;
                    $details->save();
                }
            }
        } elseif ($details->parts_type == 'Damage') {
            if (($details->claim_amount >= $this->totalAmount) && ($details->claim_amount > 0)) {
                $remaining_claim_amount = $details->claim_amount - $this->totalAmount;
                $details->claim_amount = $remaining_claim_amount;
            } else {
                $remaining_claim_amount = $details->claim_amount - $this->totalAmount;
                $details->claim_amount = 0;
                if ($remaining_claim_amount < 0) {
                    $details->claim_status = 0;
                    $json = json_encode(['amount' => $remaining_claim_amount, 'status' => 'pending']);
                    $details->extra_amount_details = $json;
                }
            }
            $details->save();
        }
        ## update device insurance
        // $deviceInsurance->claimed_amount = $this->totalAmount;
        // $deviceInsurance->save();

        $deviceClaimUpdate =  DeviceClaim::find($deviceClaim->id);
        $deviceClaimUpdate->claim_on = $details->parts_type;
        $deviceClaimUpdate->save();
        $smsResponse = $this->send_sms($customerPhone, "আপনার ইন্সুরেন্স ক্লেইম গ্রহণ করা হয়েছে। ইন্সট্যাসিউর");
        Toastr::success('Claim Successfully applied! Please wait until approval!');
        return redirect()->route('serviceCenter.insurance-claim.details', $deviceClaim->id);
    }


    /**
     * Send mobile sms
     *
     */

    public function send_sms($number, $sms)
    {
        return UserInfo::smsAPI($number, $sms);
    }
}
