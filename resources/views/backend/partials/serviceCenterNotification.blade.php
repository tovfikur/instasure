@php
    use App\Model\DeviceClaim;use App\Model\DeviceClaimRequest;
    use App\Model\DeviceInsurance;
    use App\Model\ServiceCenterDetails;
    $serviceCenter = ServiceCenterDetails::where('user_id', Auth::id())->first();
    $totalPendingReq = DeviceClaimRequest::where('sc_user_id', Auth::id())->where('status', 'pending')->count();
    $totalDeviceClaimPending = DeviceClaim::where('service_center_id', $serviceCenter->id)->where('status', 'pending')->count();
    $totalDeviceClaimProcessing = DeviceClaim::where('service_center_id', $serviceCenter->id)->where('status', 'On Processing')->count();
    $total = $totalPendingReq + $totalDeviceClaimProcessing + $totalDeviceClaimPending;
@endphp


<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-danger navbar-badge"> {{$total}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right mobile_view">
        <span class="dropdown-item dropdown-header">{{$total}} Notifications</span>

        <div class="dropdown-divider"></div>
        <a href="{{route('serviceCenter.claim-requests')}}" class="dropdown-item">
            <i class="fas fa-file-video-o mr-2"></i> <span class="count">{{$totalPendingReq}}</span> Total Pending Request claim
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-file-video-o mr-2"></i> <span class="count">{{$totalDeviceClaimPending}}</span> Total Pending Claim
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-file-video-o mr-2"></i> <span class="count">{{$totalDeviceClaimProcessing}}</span> Total Processing Claim
        </a>

    </div>
</li>
