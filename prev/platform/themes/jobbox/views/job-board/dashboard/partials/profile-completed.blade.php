@php
    $account = auth('account')->user();
    $profileCompletedPercent = 0;

    if ($account->first_name || $account->last_name) {
        $profileCompletedPercent += 50/3;
    }

    if ($account->phone) {
        $profileCompletedPercent += 50/3;
    }

    if ($account->email) {
        $profileCompletedPercent += 50/3;
    }

    if (!empty($account->avatar_id)) {
        $profileCompletedPercent += 20;
    }

    if ($account->companies->count() > 0) {
        $profileCompletedPercent += 30;
    }
@endphp

@if ($profileCompletedPercent < 100 )
    <div class="border-bottom mb-20 mt-20"></div>
    <div class="box-profile-completed text-center mb-30">
        <div id="circle-staticstic-profile-completed" data-percent-completed="{{ $profileCompletedPercent }}"></div>
        <h6 class="mb-10">{{ __('Profile Completed') }}</h6>
        <p class="font-xs color-text-mutted">{{ __('Please add detailed information to your profile. This will help you develop your career more quickly.') }}</p>
    </div>
@endif

