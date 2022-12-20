<?php

namespace App\Model;

use App\User;
use Yajra\Datatables\Datatables;
use Illuminate\Database\Eloquent\Model;

class MobileDiagnosis extends Model
{
    protected $appends = ['_invoice_image_path', '_device_images_path', '_imei_image_path', '_valid_for', '_validity_message', '_is_order_paid', '_order_expire_date', '_is_diagnosis_required'];

    protected $fillable = [
        'user_id',
        'dealer_id',
        'brand_id',
        'device_model_id',
        'imei_data_id',
        'validity_period',
        'serial_number',
        'battery_number',
        'price',
        'motherboard_status',
        'battery_health_status',
        'front_camera_status',
        'back_camera_status',
        'microphone_status',
        'ram_status',
        'rom_status',
        'display_screen_status',
        'status',
        'is_active',
    ];

    /**
     * Get device insurnace order details if order available
     * @return \App\Model\DeviceInsurance $device_insurance
     */

    private function getOrder()
    {

        $imei = $this->imei;

        $order = 0;
        if (isset($imei) && !empty($imei)) {

            $imei_1 = $this->imei->imei_1;
            if (!empty($imei_1)) {
                $device_insurances = DeviceInsurance::where(['imei_one' => $imei_1])->get();
                $device_insurance_paid = $device_insurances->filter(function ($device_insurance, $key) {
                    return $device_insurance->payment_status == 'paid';
                });
                if ($device_insurance_paid->count()) {
                    $order = $device_insurance_paid->first();
                } elseif ($device_insurances->count()) {
                    $order = $device_insurances->first();
                } else {
                    $order = 0;
                }
            }
        }
        return $order;
    }

    /**
     * Custom accessor for is order paid
     * @return atribute value
     */
    public function getIsDiagnosisRequiredAttribute()
    {

        $device_insurance = $this->getOrder();
        if ($device_insurance) {
            insRemainingDays($device_insurance) ? 1 : 0;
        }
        return 0;
    }

    /**
     * Custom accessor for is order paid
     * @return atribute value
     */
    public function getIsOrderPaidAttribute()
    {

        $device_insurance = $this->getOrder();
        if ($device_insurance) {
            return $device_insurance->payment_status;
        }
        return 0;
    }

    /**
     * Custom accessor for order expire date
     * @return atribute value
     */
    public function getOrderExpireDateAttribute()
    {
        $device_insurance = $this->getOrder();
        if ($device_insurance) {
            return dateFormat(insExpireDate($device_insurance));
        }
        return 0;
    }

    /**
     * Custom accessor for invoice image path attribute
     * @return atribute value
     */
    public function getInvoiceImagePathAttribute()
    {
        return $this->invoice_image != null
            ? asset('/')  .  $this->invoice_image
            : null;
    }


    /**
     * Custom accessor for invoice image path attribute
     * @return atribute value
     */
    public function getDeviceImagesPathAttribute()
    {
        $paths = [];
        if ($this->device_images != null) {
            $deviceImagesArr = json_decode($this->device_images);
            foreach ($deviceImagesArr as $imagePath) {
                $paths[] = asset('/') . $imagePath;
            }
        }
        return $paths;
    }


    /**
     * Custom accessor for imei image path attribute
     * @return string image path
     */
    public function getImeiImagePathAttribute()
    {
        return $this->imei_image != null
            ? asset('/')  .  $this->imei_image
            : null;
    }

    /**
     * Custom accessor for how long diagnosis report valid for
     * @return string name
     */
    public function getValidForAttribute()
    {
        return  is_expired($this->validity_period) ? is_expired($this->validity_period) : 0;
    }


    /**
     * Custom accessor for how long diagnosis report valid for
     * @return string name
     */
    public function getValidityMessageAttribute()
    {
        $data = null;
        if ($this->status == 'pending' && is_expired($this->validity_period) === false) {
            $data = "Wait for approval";
        } elseif ($this->status == 'approved' && empty(is_expired($this->validity_period))) {
            $data = "Start Diagnosis";
        } elseif ($this->status == 'approved' && !empty(is_expired($this->validity_period))) {
            $data = "Get Package";
        } elseif ($this->status == 'denied') {
            $data = "Your device is not eligible for insurance";
        }
        return $data;
    }

    /**
     * Mobile diagnosis belongs to user as customer
     * @return \App\User
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * Mobile diagnosis belongs to brand
     * @return \App\Model\User
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }


    /**
     * Mobile diagnosis belongs to brand model
     * @return \App\Model\DeviceModel
     */
    public function model()
    {
        return $this->belongsTo(DeviceModel::class, 'device_model_id');
    }


    /**
     * Mobile diagnosis belongs to brand model
     * @return \App\Model\DeviceModel
     */
    public function imei()
    {
        return $this->belongsTo(ImeiData::class, 'imei_data_id');
    }


    /**
     * Get imei data list using ajax call
     * @return response
     */

    public static function mobile_diagnosis_report_ajax()
    {

        $query = MobileDiagnosis::query()->with(['customer', 'model.brand', 'imei']);

        return Datatables::of($query)
            ->addColumn('actions', function (self $model) {

                return   $html = '<a id="edit_btn" href="' . route('admin.reports.mobile_diagnosis_report_edit', [$model]) . '" class="mr-2 edit_btn" title="Edit"><span class="badge badge-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>';
            })

            ->editColumn('user_id', function (self $model) {
                $html = "<strong>Name:</strong> {$model->customer->name}<br/>";
                $html .= "<strong>Mobile:</strong> {$model->customer->phone}<br/>";
                if ($model->customer->email) {
                    $html .= "<strong>Email:</strong> {$model->customer->email}<br/>";
                }

                return $html;
            })

            ->editColumn('device_model_id', function (self $model) {
                $html = "<strong>Brand:</strong> {$model->model->brand->name}<br/>";
                $html .= "<strong>Model:</strong> {$model->model->name}<br/>";
                $html .= "<strong>Price:</strong> " . $model->price . ' ' . config('settings.currency') . "<br/>";

                return $html;
            })
            ->editColumn('serial_number', function (self $model) {
                $html = "<strong>Serial Number:</strong> {$model->serial_number}<br/>";
                $html .= "<strong>Battery Number:</strong> {$model->battery_number}<br/>";
                if (!empty($model->imei)) {
                    $html .= "<strong>IMEI One:</strong> {$model->imei->imei_1}<br/>";
                } else {
                    $html .= "<strong>IMEI One:</strong> <del class='badge badge-info'>Not Set</del><br/>";
                }

                return $html;
            })

            ->addColumn('parts_status', function (self $model) {
                $html = '';
                if ($model->status == 'pending') {
                    $html .= "<strong>Report Status:</strong> <span class='badge badge-warning'>" . ucfirst($model->status) . "</span><br/>";
                } elseif ($model->status == 'approved') {
                    $html .= "<strong>Report Status:</strong> <span class='badge badge-success'>" . ucfirst($model->status) . "</span><br/>";
                } else {
                    $html .= "<strong>Report Status:</strong> <span class='badge badge-danger'>" . ucfirst($model->status) . "</span><br/>";
                }

                if ($model->motherboard_status) {
                    $html .= "<strong>Motherboard Status:</strong> <span class='badge badge-success'>Ok</span> <br/>";
                } else {
                    $html .= "<strong>Motherboard Status:</strong> <span class='badge badge-danger'>Not Ok</span> <br/>";
                }
                if (empty($model->validity_period)) {
                    $html .= "<strong>Validity Status:</strong> <span class='badge badge-secondary'> Not Set</span> <br/>";
                } elseif ($validFor = is_expired($model->validity_period)) {
                    $html .= "<strong>Valid For:</strong> <span class='badge badge-info minuiteCounter'>" . $validFor . " Minutes</span> <br/>";
                } else {
                    $html .= "<strong>Validity Status:</strong> <span class='badge badge-secondary'>" . 'Expired' . "</span> <br/>";
                }

                return $html;
            })

            ->orderColumn('id', '-id $1')
            ->rawColumns(['actions', 'user_id', 'device_model_id', 'parts_status', 'serial_number'])
            ->toJson();
    }
}
