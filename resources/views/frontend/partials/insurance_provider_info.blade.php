<div class="card">
    <div class="card-body">
        <h5 class="card-title">Select A Policy Provider</h5>
        <input type="hidden" name="age" value="{{ $age }}" class="form-control" readonly>
        <input type="hidden" name="total_date" value="{{ $total_date }}" class="form-control" readonly>

        <div class="row">
            @forelse($travelPlanCharts as $key => $travelPlanChart)
                <div class="col-md-4">
                    <div class="big" id="{{ $key }}">
                        <input id="chb-{{ $key }}" class="chb" name="package_id"
                            value="{{ $travelPlanChart->id }}" type="radio" {{ $key == 0 ? 'checked' : '' }} />
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span>
                                    <img src="{{ asset('uploads/policy_provider/logo/' . $travelPlanChart->policyProvider->logo) }}"
                                        alt="policyProviderLogo" width="30" class="mr-1">
                                </span>
                                {{ $travelPlanChart->policyProvider->company_name }}
                            </li>
                            <li class="list-group-item">
                                Insurance Price: {{ $travelPlanChart->ins_price }}
                                {{ config('settings.currency') }}
                            </li>
                            <li class="list-group-item">Stay {{ $total_date }} days</li>
                        </ul>
                    </div>
                </div>

            @empty
                <p class="text-danger">Your criteria does not match with any package.</p>
            @endforelse
        </div>
    </div>
</div>
@if (!empty($travelPlanCharts[0]['id']))
    <div class="text-center">
        <button type="submit" class="default-btn mt-4 w-100">Submit<span></span>
        </button>
    </div>
@endif

<script src="https://code.jquery.com/jquery-2.2.4.min.js"
integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        if ($("input[name='package_id']:checked")) {
            $("#0").toggleClass('hli');
        }
    })
    $('.big').click(function() {
        $('.hli').toggleClass('hli');
        $(this).toggleClass('hli');
        var Id = $(this).find('input[type=radio]').attr('id');
        document.getElementById(Id).click();

    });
</script>
