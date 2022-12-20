@if (isset($child_dealers) && count($child_dealers))

    <label for="child_dealer_id" class="col-md-3 col-form-label">
        Child Dealers
    </label>
    <div class="col-md-9">
        <select required="required" name="child_dealer_id" id="child_dealer_id" class="form-control">

            @foreach ($child_dealers as $dealer)
                <option value="{{ $dealer->id }}">
                    {{ $dealer->com_org_inst_name }}
                </option>
            @endforeach
        </select>
    </div>

@endif
