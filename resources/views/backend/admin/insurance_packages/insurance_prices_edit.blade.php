@foreach($insuranceTypes as $insuranceType)
    @php
    $price = \App\Model\InsurancePrice::where('insurance_type_id',$insuranceType->id)->where('insurance_package_id',$insurancePackage->id)->first();
    @endphp
    <div class="form-group row">
        <div class="col-lg-3 ">
            <input type="hidden" name="choice_no[]" value="{{$insuranceType->id}}">
            <input type="text" class="form-control" name="choice[]" value="{{$insuranceType->name}}" placeholder="{{ $insuranceType->name }}" readonly>
        </div>
        <div class="col-lg-4">
            <select class="form-control" name="price_type_{{$insuranceType->id}}">
                <option>Select price Type</option>
                <option value="flat" {{$price->type == 'flat' ? 'selected':''}}>Flat</option>
                <option value="percentage" {{$price->type == 'percentage' ? 'selected':''}}>Percentage</option>
            </select>
        </div>
        <div class="col-lg-5">
            <input type="text" class="form-control" name="choice_options_{{$insuranceType->id}}" value="{{$price->value }}" >
        </div>
    </div>
@endforeach
