<div class="bg-info pl-2 pt-2 pb-1 mt-2">
    <h5 class="text-center">{{ ucwords($insurancePackage->package_name) }}</h5>
</div>
<table class="table table-bordered">
    <thead>
        <tr class="table-active">
            <th class="text-center" width="25%">
                Insurance Type
            </th>
            <th class="text-center" width="50%">
                Price
            </th>
            <th class="text-center" width="25%">
                Action
            </th>

        </tr>
    </thead>
    <tbody>


        <input type="hidden" name="package_id" value="{{ $insurancePackage->id }}">

        @foreach ($insurancePrices as $key => $insurancePrice)
            <tr>
                <td>
                    {{ $insurancePrice->insuranceType->name }}
                    <input type="hidden" name="insuranceType_name[]"
                        value="{{ $insurancePrice->insuranceType->name }}">
                </td>
                <!-- Jodi insurance type excluded hoi, ejonno screen protection  -->
                @if ($insurancePrice->insuranceType->check_inc_type == 1 && $insurancePrice->include_type == 'excluded')
                    {{-- {{appliedOnHandsetValueCalculation($device_price,$insurancePrice->value,$insurancePrice->type, $insurancePrice->applied_value_two)}} --}}
                @else
                    <td>
                        @if ($insurancePrice->include_type == 'included')
                            {{ appliedOnHandsetValueCalculation($device_price, $insurancePrice->value, $insurancePrice->type, $insurancePrice->applied_value_two) }}
                            {{ config('settings.currency') }}
                        @else
                            {{ incPackBtExcItems($device_price, $insurancePrice->value, $insurancePrice->type) }}
                            {{ config('settings.currency') }}
                        @endif

                        <input type="hidden" name="in[]"
                            value="{{ InsurancePriceCalculation($insurancePrice->id, $device_price) }}">
                        {{-- {{$device_price * $insurancePrice->value / 100}} --}}
                    </td>
                @endif
                {{-- <td> --}}
                {{-- <input type="hidden" id="" value="{{$insurancePrice->type}}" readonly> --}}
                {{-- {{$insurancePrice->type}} --}}
                {{-- </td> --}}
                {{-- <td> --}}
                {{-- <input type="hidden" name="in" value="{{$insurancePrice->value}}" readonly> --}}
                {{-- {{$insurancePrice->value}} --}}
                {{-- </td> --}}
                @if ($insurancePrice->insuranceType->check_inc_type == 1 && $insurancePrice->include_type == 'excluded')
                    <td colspan="2" id="blure">

                        <input type="hidden" name="device_parts_name"
                            value="{{ $insurancePrice->insuranceType->name }}" id="device_parts_name">
                        <input type="hidden" name="protection_times_for" value="1" id="times_for">
                        <label>
                            <input class="p-2 time_chng1" checked type="radio" name="h_a_o_v"
                                value="{{ appliedOnHandsetValueCalculation($device_price, $insurancePrice->value, $insurancePrice->type, $insurancePrice->applied_value_one) }}">
                            One
                            Times


                            {{ appliedOnHandsetValueCalculation($device_price, $insurancePrice->value, $insurancePrice->type, $insurancePrice->applied_value_one) }}
                            {{ config('settings.currency') }}
                        </label>
                        <label>

                            <input class="ml-2 time_chng2" type="radio" name="h_a_o_v"
                                value="{{ appliedOnHandsetValueCalculation($device_price, $insurancePrice->value, $insurancePrice->type, $insurancePrice->applied_value_two) }}">
                            Two
                            times
                            {{ appliedOnHandsetValueCalculation($device_price, $insurancePrice->value, $insurancePrice->type, $insurancePrice->applied_value_two) }}
                            {{ config('settings.currency') }}
                        </label>
                        <label>

                            <input class="ml-2 time_chng0" type="radio" name="h_a_o_v" value="0">
                            None of any
                        </label>

                    </td>
                @else
                    <td>
                        <input id="index_{{ $key }}"
                            type="{{ $insurancePrice->include_type == 'included' ? 'hidden' : 'checkbox' }}"
                            name="insurance_price_id[]" value="{{ $insurancePrice->id }}">
                        {{ $insurancePrice->include_type == 'included' ? 'included ' : '' }}
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
    $("#index_1").click(function() {
        // alert($(this).val());
        if ({{ $key }} == 2) {
            if ($('#index_1').is(':checked')) {
                //$('input:checkbox').not(this).prop('checked', this.checked);
                //alert($(this).val());
                $('input[name=h_a_o_v]').attr("disabled", true);
                $('input[name=screen_protection_times_for]').attr("disabled", true);
                $('#blure').addClass('test');
                //alert('if condition achieve')
            } else {
                // alert('else condition achieve')
                $('input[name=h_a_o_v]').attr("disabled", false);
                $('input[name=screen_protection_times_for]').attr("disabled", false);
                $('#blure').removeClass('test');
            }
        }
        //$('input:checkbox').not(this).prop('checked', this.checked);
    });
    $('.time_chng1').change(function() {
        $('#times_for').val('1')
    })

    $('.time_chng2').change(function() {
        $('#times_for').val('2')
    })
    $('.time_chng0').change(function() {
        $('#times_for').val('0')
    })
</script>
