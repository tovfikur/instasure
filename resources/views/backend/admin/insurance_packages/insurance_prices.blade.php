@foreach($insuranceTypes as $insuranceType)
    <div class="form-group row ">
        <div class="col-md-3 ">
            <input type="hidden" name="choice_no[]" value="{{$insuranceType->id}}">
            <label for="choice">Ins type</label>
            <input type="text" class="form-control" name="choice[]" value="{{$insuranceType->name}}" id="choice"
                   placeholder="{{ $insuranceType->name }}" readonly>
        </div>
        <div class="col-md-2">
            <label for="price_type_{{$insuranceType->id}}">Type</label>
            <select class="form-control" name="price_type_{{$insuranceType->id}}" id="price_type_{{$insuranceType->id}}">
                <option value="flat">Flat</option>
                <option value="percentage">Percentage</option>
            </select>
        </div>
        <div class="col-lg-2">
            <label for="choice_options_{{$insuranceType->id}}">Price</label>
            <input type="number" step="0.01" class="form-control" name="choice_options_{{$insuranceType->id}}"
                   placeholder="{{'Enter Insurance Price' }}">
        </div>
        <div class="col-lg-1" style="{{$insuranceType->check_inc_type == 0 ? 'display: none': ''}}">
            <label for="applied_value_one_{{$insuranceType->id}}"><small>applied val-1</small></label>
            <input type="number" step="0.01" value="0" class="form-control" name="applied_value_one_{{$insuranceType->id}}"
                   placeholder="{{'Enter Applied value 1' }}">
        </div>
        <div class="col-lg-1" style="{{$insuranceType->check_inc_type == 0 ? 'display: none': ''}}">
            <label for="applied_value_two_{{$insuranceType->id}}"><small>applied two-1</small></label>
            <input type="number" step="0.01" value="0" class="form-control" name="applied_value_two_{{$insuranceType->id}}"
                   placeholder="{{'Enter Applied value 2 '}}">
        </div>
        <div class="col-lg-2 include_type" style="display: none;">
            <label for="include_type_{{$insuranceType->id}}">Inc/Exc Type</label>
            <select class="form-control" name="include_type_{{$insuranceType->id}}" id="include_type_{{$insuranceType->id}}">
                <option value="excluded">Excluded</option>
                <option value="included">Included</option>
            </select>
        </div>
    </div>
@endforeach
