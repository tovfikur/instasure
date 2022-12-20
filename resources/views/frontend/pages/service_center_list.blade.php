<ul>

    @if ($serviceCenters->count() > 0)
        <h4>Here are the Nearest Service Center:</h4>
        <form action="{{ route('user.insurance-claim-request.store') }}" method="post">
            @csrf
            <input type="hidden" name="device_insurance_id" value="{{ $deviceInsurance->id }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="sc_user_id" class="c-form-label text-bold">Service Center</label>
                        <select name="sc_user_id" id="sc_user_id" class="form-control">
                            <option>Select</option>
                            @foreach ($serviceCenters as $serviceCenter)
                                <option value="{{ $serviceCenter->user_id }}">
                                    {{ $serviceCenter->service_center_name }}
                                    ({{ $serviceCenter->address }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="pick_up_status" class="c-form-label text-bold">Device PickUp Status</label>
                        <select name="pick_up_status" id="pick_up_status" class="form-control">
                            <option>Select</option>
                            <option value="service_center">To Service Center</option>
                            <option value="home">From Home</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-2">
                        <label for="claim_note" class="c-form-label text-bold">Claim Note</label>
                        <textarea name="claim_note" id="claim_note" class="form-control" rows="4"
                            placeholder="ex: Screen Protection. Screen a "></textarea>
                    </div>
                </div>
                <button type="submit" class="default-btn mt-4 w-100">Submit</button>
            </div>
        </form>
    @else
        <div class="text-center">
            <h4 class="text-danger">No service center available to this location. Please contact below</h4>
            <blockquote class="blockquote">
                <small class="mb-0">
                    @if ($default_address)
                        {{ $default_address->value }}
                    @else
                        2nd Floor, House#60, Road#8&9, Block-F, Banani, Dhaka-1213 Bangladesh
                    @endif
                </small>
            </blockquote>
        </div>
    @endif
</ul>
