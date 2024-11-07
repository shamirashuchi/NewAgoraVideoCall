
@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card-style-1 hover-up">
            <div class="card-image">
            <img src="{{ Theme::asset()->url('imgs/page/dashboard/computer.svg') }}" alt="Total Jobs">
            </div>

            <div class="card-info">
                <div class="card-title">
                    <h3>0
                        <span class="font-sm">Total Jobs</span>
                    </h3>
                </div>
                <p class="color-text-paragraph-2">All status included</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-style-1 hover-up">
            <div class="card-image">
            <img src="{{ Theme::asset()->url('imgs/page/dashboard/computer.svg') }}" alt="Total Jobs">
            </div>

            <div class="card-info">
                <div class="card-title">
                    <h3>0
                        <span class="font-sm">Total Companies</span>
                    </h3>
                </div>
                <p class="color-text-paragraph-2">All status included</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-style-1 hover-up">
            <div class="card-image">
            <img src="{{ Theme::asset()->url('imgs/page/dashboard/computer.svg') }}" alt="Total Jobs">
            </div>

            <div class="card-info">
                <div class="card-title">
                    <h3>0
                        <span class="font-sm">Total Applicants</span>
                    </h3>
                </div>
                <p class="color-text-paragraph-2">In 0 Jobs</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="panel-white">
            <header class="panel-head">
                <h5>New Applicants</h5>
            </header>
            <article class="panel-body">
                <div class="new-member-list">
                    <p class="text-muted">No new applicants</p>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel-white">
            <header class="panel-head">
                <h5>Recent activities</h5>
            </header>
            <article class="panel-body">
                <ul class="verti-timeline list-unstyled font-sm">
                    <li>
                        <p class="text-muted">No activities</p>
                    </li>
                </ul>
            </article>
        </div>
    </div>
</div>
<div class="panel-white">
    <header class="panel-head">
        <h4>Jobs are about to expire</h4>
    </header>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table align-middle table-nowrap mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="align-middle" scope="col">Job Name</th>
                        <th class="align-middle" scope="col">Company</th>
                        <th class="align-middle" scope="col">Expire date</th>
                        <th class="align-middle" scope="col">Status</th>
                        <th class="align-middle" scope="col">Total applicants</th>
                        <th class="align-middle" scope="col">View Details</th>
                        <th class="align-middle" scope="col">Renew</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="#" class="fw-bold">Sample Job Name</a></td>
                        <td>Sample Company</td>
                        <td>Sample Date</td>
                        <td>Sample Status</td>
                        <td>0</td>
                        <td><a href="#" class="btn btn-xs">View</a></td>
                        <td><a href="#" class="btn btn-xs btn-success">Renew</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
