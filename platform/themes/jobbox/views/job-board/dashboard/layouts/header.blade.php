@php
    $account = auth('account')->user();
@endphp
{!! Assets::renderHeader(['core']) !!}
@if (BaseHelper::siteLanguageDirection() == 'rtl')
    <link rel="stylesheet" href="{{ Theme::asset()->url('plugins/bootstrap/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ Theme::asset()->url('css/style-dashboard-rtl.css') }}">
@else
    <link rel="stylesheet" href="{{ Theme::asset()->url('plugins/bootstrap/bootstrap.min.css') }}">
@endif

<link rel="stylesheet" href="{{ Theme::asset()->url('css/style-dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/core/core/base/css/themes/default.css') }}?v={{ get_cms_version() }}">

@if (BaseHelper::siteLanguageDirection() == 'rtl')
    <link rel="stylesheet" href="{{ asset('vendor/core/core/base/css/rtl.css') }}?v={{ get_cms_version() }}">
@endif
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


@php
    $account = auth('account')->user();
    $type = $account->type->getValue();
@endphp
@php
    Theme::asset()->container('footer')->usePath()->add('candidates-filter', 'js/candidates-filter.js');
@endphp
@php
            use Illuminate\Support\Facades\DB;

          
            $search = request()->input('search');

           
            $query = DB::table('jb_accounts');

            

            $talents = $query->where('type', 'job-seeker')->get();
            

           
        @endphp
        <!-- @if ($account->type == "job-seeker") -->
<style>
    .setHeader{
        margin-top:0px;
        position: fixed;
    }
    .bgtalent a{
        color: white;
    }
    .header .main-header .header-left {
    align-items: center;
    display: flex;
   min-width: 470px;
}

    .bgtalent a:hover{
         background-color: white;
         color:#F9A620;
         padding: 5px 5px;
    }
    .header .main-header .header-left .header-logo {
    margin-right: 0;
    margin-left: 150px;
    min-width: 120px;
}
    @media (max-width: 567px) {
        .setHeader{
            margin-top:0px;
            margin-bottom: 0px;
        }
    }
</style>
<!-- @endif
@if ($account->type == "employer")
<style>
    .setHeader{
        margin-top:40px;
    }
    .bgtalent a{
        color: white;
    }
    .header .main-header .header-left {
    align-items: center;
    display: flex;
   min-width: 1370px;
}

    .bgtalent a:hover{
         background-color: white;
         color:#F9A620;
         padding: 5px 5px;
    }
    @media (min-width: 1200px) and (max-width: 1299px) {
        .header .main-header .header-left {
    align-items: center;
    display: flex;
   min-width: 650px;
}
    .header .main-header .header-right {
    align-items: center;
    display: flex;
   min-width: 60px;
   margin-right:0px;
}
}
@media (min-width: 1300px) and (max-width: 1400px) {
        .header .main-header .header-left {
    align-items: center;
    display: flex;
   min-width: 850px;
}
    .header .main-header .header-right {
    align-items: center;
    display: flex;
   min-width: 60px;
   margin-right:0px;
}
}

    @media (max-width: 567px) {
        .setHeader{
            margin-top:0px;
            margin-bottom: 0px;
        }
    }
</style>
@endif
@if ($account->type == "consultant")
<style>
    .setHeader{
        margin-top:40px;
    }
    .bgtalent a{
        color: white;
    }
    .header .main-header .header-left {
    align-items: center;
    display: flex;
   min-width: 1300px;
}

    .bgtalent a:hover{
         background-color: white;
         color:#F9A620;
         padding: 5px 5px;
    }
    @media (min-width: 1200px) and (max-width: 1299px) {
        .header .main-header .header-left {
    align-items: center;
    display: flex;
   min-width: 600px;
}
    .header .main-header .header-right {
    align-items: center;
    display: flex;
   min-width: 60px;
   margin-right:0px;
}
}
@media (min-width: 1300px) and (max-width: 1400px) {
        .header .main-header .header-left {
    align-items: center;
    display: flex;
   min-width: 750px;
}
    .header .main-header .header-right {
    align-items: center;
    display: flex;
   min-width: 60px;
   margin-right:0px;
}
}

    @media (max-width: 567px) {
        .setHeader{
            margin-top:0px;
            margin-bottom: 0px;
        }
    }
</style>
@endif -->

<header class="header setHeader">
    <div class="container">
   
        <div class="main-header">
            <div class="header-left d-flex justify-content-between">
                <div class="header-logo">
                    <a class="d-flex" href="{{ route('public.account.dashboard') }}">
                        @if ($logo = theme_option('logo_employer_dashboard', theme_option('logo')))
                            <img style="max-height:40px;" src="{{ RvMedia::getImageUrl($logo) }}" class="logo" alt="{{ theme_option('site_title') }}">
                        @endif
                    </a>
                </div>
            </div>
            <div class="header-right ">
                <div class="block-signin d-flex align-items-center gap-3 justify-content-end">
               
                    <!-- @if ($account->canPost())
                        <ul class="nav">
                            <a class="btn btn-default" href="{{ route('public.account.jobs.create') }}">
                                <li class="fa fa-edit mr-5"></li>
                                {{ trans('plugins/job-board::dashboard.post_a_job') }}</a>
                        </ul>
                    @endif -->
                    <ul class="nav">
                    @if (JobBoardHelper::isEnabledCreditsSystem() && $type  ==="jobseeker")
                            <a class="" href="{{ route('public.account.test') }}">
                                Get Verified
                            </a>
                            @endif
                    </ul>
                    <ul class="nav">
                        @if (JobBoardHelper::isEnabledCreditsSystem())
                        @if ($account->type == "job-seeker")
                         
                                <a href="{{ route('public.account.packages') }}" class="btn nav-link btn-icon"style="background-color: #F9A620; border-color: #F9A620; color: white; display: block;">
                                {!! __('Buy') . '&nbsp;&nbsp;' . __('Credits') !!}
                          
                                    
                                </a>
                            </li>
                            @elseif($account->type == "employer")
                           
                                <a href="{{ route('public.account.packages') }}" class="btn nav-link btn-icon" style="background-color: #0879EA; border-color: #0879EA; color: white; display: block;">
                                {!! __('Buy') . '&nbsp;&nbsp;' . __('Credits') !!}
                         
                                    
                                </a>
                            </li>
                            @elseif($account->type == "consultant")
                           
                                <a href="{{ route('public.account.packages') }}" class="btn nav-link btn-icon"
                               
                                   style="background-color: #800080; border-color: #800080; color: white; display: block;">
                                   {!! __('Buy') . '&nbsp;&nbsp;' . __('Credits') !!}
                           
                                    
                                </a>
                           
                        @endif
                        @endif
                    </ul>
                     <!-- <span class="mr-2 badge badge-danger">{{ $account->credits }}</span> -->
                     @if ($account->type == "job-seeker")
                    <ul class="nav">
                       
                      
                            <a class="btn" href="{{ route('consultants') }}" style="background-color: #F9A620; border-color: #F9A620; color: white; display: block;">
                            {!! __('Book') . '&nbsp;&nbsp;' . __('Consultant') !!}
                            </a>
                            
                            </ul>
                            <a class="btn" href="{{ route('videos') }}" style="background-color: #F9A620; border-color: #F9A620; color: white; display: block;">
    {!! __('Join') . '&nbsp;&nbsp;' . __('Meeting') !!}
</a>

</ul>
                            @elseif($account->type == "employer")
                            <ul class="nav">
                            <a class="btn" href="{{ route('consultants') }}" style="background-color: #F9A620; border-color: #F9A620; color: white; display: block;">
                            {!! __('Book') . '&nbsp;&nbsp;' . __('Consultant') !!}
                            </a>
                            
                            </ul>
                            @endif
                            
                       
                    </ul>
                    
                    <ul class="nav">
                    @if ($account->type == "job-seeker")
                    <a class="btn" href="{{ url('/jobs') }}" style="background-color: #F9A620; border-color: #F9A620; color: white; display: block;">
                                Search
                            </a>
                            @elseif($account->type == "consultant")
                            <a class="btn" href="{{ url('/candidates') }}" style="background-color: #800080; border-color: #800080; color: white; display: block;">
                                Search
                            </a>
                            @endif
                        
                       
                     
                      
    
                    
                      
                    </ul>
                    <!-- <ul class="nav">
                        @if (is_plugin_active('language'))
                            @include(JobBoardHelper::viewPath('dashboard.partials.language-switcher'))
                        @endif
                    </ul> -->

                    <div class="member-login">
                        <img alt="" src="{{ $account->avatar_thumb_url }}">
                        <div class="info-member">
                            <strong class="color-brand-1">{{ $account->name }}</strong>
                            <div class="dropdown">
                                <a class="font-xs color-text-paragraph-2 icon-down" id="dropdownProfile" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">{{ __('My Account') }}</a>
                                <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownProfile">
                                    <li><a class="dropdown-item" href="{{ route('public.account.settings') }}">{{ __('My Account') }}</a></li>
                                    <li>
                                        <form action="{{ route('public.account.logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item">{{ __('Logout') }}</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const suggestionsContainer = document.getElementById('suggestions');

            searchInput.addEventListener('input', function () {
                const query = searchInput.value;

                if (query.length < 2) {
                    suggestionsContainer.innerHTML = '';
                    return;
                }

                // Fetch suggestions from the current route
                fetch(`{{ url()->current() }}?search=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        suggestionsContainer.innerHTML = '';
                        for (const suggestion of data) {
                            const suggestionItem = document.createElement('a');
                            suggestionItem.className = 'list-group-item list-group-item-action';
                            suggestionItem.textContent = suggestion;
                            suggestionItem.href = `{{ url()->current() }}?search=${encodeURIComponent(query)}`;
                            suggestionsContainer.appendChild(suggestionItem);
                        }
                    });
            });
        });
    </script> -->
    <!-- <script>
    function fetchResults() {
        const searchTerm = document.getElementById('search').value;

        fetch(`/search?search=${encodeURIComponent(searchTerm)}`)
            .then(response => response.json())
            .then(data => {
                const resultsDiv = document.getElementById('results');
                resultsDiv.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(talent => {
                        resultsDiv.innerHTML += `<p>${talent.first_name} ${talent.last_name}</p>`;
                    });
                } else {
                    resultsDiv.innerHTML = '<p>No results found</p>';
                }
            })
            .catch(error => console.error('Error fetching results:', error));
    }
</script> -->
<!-- <script>
    // Ensure that the DOM is fully loaded before accessing elements
    document.addEventListener('DOMContentLoaded', function() {
        if ($talents->isNotEmpty()){
        const suggestionsDiv = document.getElementById('suggestions');
        if (suggestionsDiv) {
            suggestionsDiv.style.display = 'block'; 
        }
    }
    });
</script> -->

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Function to remove a query parameter
function removeQueryParam(param) {
    const url = new URL(window.location.href);
    url.searchParams.delete(param);
    window.history.replaceState({}, '', url);
}

// Remove 'search' query parameter
removeQueryParam('search');

    const Toptalents = @json($talents); // You can use `@json($talents)` as a cleaner alternative
    
    console.log(Toptalents);
    
        // Ensure the input field is available in the DOM
        const searchInput = document.getElementById('search');
        
        if (!searchInput) {
            console.error('Element with ID "search" not found');
            return;
        }

        // Add input event listener
        searchInput.addEventListener('input', function() {
    
       
    const searchQuery = this.value.toLowerCase();
    console.log("searchquery",searchQuery);
    const talentListContainer = document.getElementById('talentListContainer');
    talentListContainer.innerHTML = '';

    if (searchQuery.length > 0) {
        const filteredTalents = talents.filter(talent =>
            talent.first_name.toLowerCase().includes(searchQuery) || 
            talent.last_name.toLowerCase().includes(searchQuery)
        );
        
        if (filteredTalents.length > 0) {
            filteredTalents.forEach(talent => {
                const talentItem = document.createElement('div');
                talentItem.classList.add('mb-3', 'bgtalent');
                talentItem.innerHTML = `<a href="/candidates/${talent.first_name.toLowerCase()}-${talent.last_name.toLowerCase()}">${talent.first_name} ${talent.last_name}</a>`;
                talentListContainer.appendChild(talentItem);
            });
            talentListContainer.classList.remove('d-none');
        } else {
            talentListContainer.classList.add('d-none');
        }
    } else {
        talentListContainer.classList.add('d-none');
    }
});
});
</script>
