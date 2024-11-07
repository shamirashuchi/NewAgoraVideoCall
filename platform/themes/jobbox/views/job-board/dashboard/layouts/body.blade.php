@include(JobBoardHelper::viewPath('dashboard.layouts.header'))
@include(JobBoardHelper::viewPath('dashboard.layouts.menu-mobile'))
<style>
    .setMainContent{
        margin-top:100px;
        margin-left:0px;
    }
    .setNav{
        margin-left: 100px;
        margin-top: 120px;
        margin-bottom: 100px;
    }
    @media (min-width: 320px) and (max-width: 575px) {
      
    }

    @media (min-width: 320px) and (max-width: 575px) {
        .setNav{
        margin-left: 0px;
        margin-top: 0px;
        margin-bottom: 0px;
    }
        }
    @media (min-width: 576px) and (max-width: 767.98px) {
        .setMainContent{
            margin-top:0px;
            margin-left:0px;
            background-color: #EFF6F9;
        }
        .setNav{
            margin-left: 0px;
            margin-top: 0px
        }
    }
    @media (min-width: 768px) and (max-width: 991.98px) {
        .setMainContent{
            margin-top:0px;
            margin-left:0px;
            background-color: #EFF6F9;
        }
        .setNav{
            margin-left: 0px;
            margin-top: 0px
        }
    }

</style>

<main class="main" id="mainClose">

    <div class="nav setNav">
        <nav class="nav-main-menu">
            @include(JobBoardHelper::viewPath('dashboard.layouts.menu'))
        </nav>
    </div>
    <div class="box-content">
        <div class="content">
{{--            @include(JobBoardHelper::viewPath('dashboard.layouts.breadcrumb'))--}}

            <div id="app" class="setMainContent">
                @yield('content')
            </div>
        </div>

        @include(JobBoardHelper::viewPath('dashboard.layouts.footer'))
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var mainClose = document.getElementById('mainClose');
        if (mainClose) {
            var currentUrl = window.location.href;
            var baseUrl = window.location.origin;
            if (currentUrl === baseUrl + "/account/home") {
                mainClose.style.backgroundColor = '#05264E';
            } else if (currentUrl === baseUrl + "/account/packages") {
                mainClose.style.backgroundColor = '#EFF6F9';
            } else if (currentUrl === baseUrl + "/account/settings") {
                mainClose.style.backgroundColor = '#05264E';
            }
        }
    });
</script>

</main>
