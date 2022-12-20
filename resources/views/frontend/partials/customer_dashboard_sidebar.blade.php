<style>
    .activeMe {
        background: #002e5b;
        color: #fff !important;
    }
</style>
<div class="single-pricing-box">
    <div class="pricing-header ">
        <div class="card2">
            <div class="avatar">
                @isset(Auth::user()->avatar_original)
                    <img src="{{ url(Auth::user()->avatar_original) }}" alt="avatar" />
                @endisset
            </div>
            <div class="content">
                <p class="text-white">{{ Auth::user()->name }}<br>
            </div>
        </div>
    </div>
    <a href="{{ route('user.dashboard') }}">
        <div class="mb-1 {{ Request::is('dashboard') ? 'activeMe1' : '' }}" id="hoverMe">
            Dashboard
        </div>
    </a>
    <a href="{{ route('user.profile') }}">
        <div class="mb-1 {{ Request::is('profile') ? 'activeMe' : '' }}" id="hoverMe">
            Profile Manage
        </div>
    </a>
    <a href="{{ route('insurance.quotation.form') }}">
        <div class="mb-1 {{ Request::is('medical/insurance/quotation') ? 'activeMe' : '' }}" id="hoverMe">
            Get Travel Insurance
        </div>
    </a>
    <a href="{{ route('user.insurance.purchase.history') }}">
        <div class="mb-1 {{ Request::is('insurance/purchase/*') ? 'activeMe' : '' }}" id="hoverMe">
            Travel Insurance History
        </div>
    </a>
    <a href="{{ route('user.device-insurance.history') }}">
        <div class="mb-1 {{ Request::is('device-insurance/history') || Request::is('device-insurance/details/*') || Request::is('device-insurance-claim') ? 'activeMe' : '' }}"
            id="hoverMe">
            Device Insurance History
        </div>
    </a>
    <a href="{{ route('user.device-insurance.claim-requests') }}">
        <div class="mb-1 {{ Request::is('device-insurance/support-tickets') ? 'activeMe' : '' }}" id="hoverMe">
            Device Support Tickets
        </div>
    </a>

    <a href="{{ route('user.insuranceClaimHistory') }}">
        <div class="mb-1 {{ Request::is('insurance/claim/history') ? 'activeMe' : '' }}" id="hoverMe">
            Device Claim History
        </div>
    </a>
    <a href="#" href="{{ route('logout') }}"
        onclick="event.preventDefault();
       document.getElementById('logout-form').submit();">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <div class="mb-1" id="hoverMe">
            Sign Out
        </div>
    </a>

</div>
