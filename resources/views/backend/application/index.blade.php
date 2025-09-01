@extends('backend.partials.master')

@section('title')
application
@endsection

@section('container')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y mb-4">
        <div class="card ">
            <div class="d-flex justify-content-between align-items-center card-header mb-3">
                <h5 class="mb-0"> <i class='bx  bx-slider'  ></i> application</h5>
                {{-- @if(hasAdminPermission('application_create'))
                <a href="{{ route($info->first_button_route) }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>
                    {{ $info->first_button_title }}
                </a>
                @endif --}}
            </div>

             <div class="card-body pb-0">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label" for="user">User</label>
                            <select class="form-select custom-select search-select" id="user" name="user" data-live-search="true">
                                <option value="">--Choose--</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected(request('user')==$user->id)>
                                    {{ $user->name }}
                                </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    @if (auth()->guard('admin')->user()->role?->slug == 'admin')
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="company">Company</label>
                                <select class="form-select custom-select search-select" id="company" name="company" data-live-search="true">
                                    <option value="">--Choose--</option>
                                    @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" @selected(request('company')==$company->id)>
                                        {{ $company->name }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    @endif

                    @if (auth()->guard('admin')->user()->role?->slug == 'admin')
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="job">Jobs</label>
                                <select class="form-select custom-select search-select" id="job" name="job" data-live-search="true">
                                    <option value="">--Choose--</option>
                                    @foreach ($jobs as $job)
                                    <option value="{{ $job->id }}" @selected(request('job')==$job->id)>
                                        {{ $job->title }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-3 mb-2">
                        <div class="form-group">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select white-dropdown custom-select search-select" name="status" id="status">
                                <option value="">--Choose--</option>
                                @foreach (applicationStatus() as $status => $item)
                                <option value="{{ $status }}" @selected(request('status')==$status)>
                                    {{ $item }}
                                </option>
                                @endforeach


                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button type="button" class="btn rounded-pill btn-dark" onclick="filterOnEnter(event, filterItems)">Filter</button>

                        <!-- Cross Button to Clear Filters -->
                        <button id="clearButton" type="button" class="btn rounded-pill btn-icon btn-danger {{ request()->query() ? '' : 'd-none' }}" onclick="clearFilters(event)">
                            <span class="fas fa-times"></span>
                        </button>
                    </div>




                </div>
            </div>
           

            <div class="card-body">
                <div class="table-responsive text-nowrap mb-3">

                    <table class="table pb-0">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Job Seeker (user)</th>
                                <th>company</th>
                                <th>Job</th>
                                <th>Status</th>
                                <th>Resume</th>
                                <th>payment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $serial = 1; @endphp
                            @foreach ($data as $row)
                            <tr>
                                <td>{{ $serial }}</td>
                                <td>{{ $row->user?->name }}</td>
                                <td>{{ $row->job?->company?->name }}</td>
                                <td>{{ $row->job?->title }}</td>
                                <td>{{ $row->status }}</td>
                                <td>
                                    @if($row->resume)
                                        <a href="{{ asset('storage/' . $row->resume) }}" class="btn-table" download>
                                            Download CV
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $row->payment_status }}</td>
                                <td class="text-nowrap">

                                    @if(hasAdminPermission('application_edit'))
                                  
                                     @if ($row->payment_status === 'paid')
                                        @if ($row->status === 'accepted')
                                            {{-- Show only Reject button --}}
                                            <form action="{{ route('application.reject', $row->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" title="Reject">
                                                    Reject
                                                </button>
                                            </form>
                                        @elseif ($row->status === 'rejected')
                                            {{-- Show only Accept button --}}
                                            <form action="{{ route('application.accept', $row->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="Accept">
                                                    Accept
                                                </button>
                                            </form>
                                        @else
                                            {{-- Show both Accept and Reject buttons --}}
                                            <form action="{{ route('application.accept', $row->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="Accept">
                                                    Accept
                                                </button>
                                            </form>

                                            <form action="{{ route('application.reject', $row->id) }}" method="POST" style="display: inline; margin-left: 5px;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" title="Reject">
                                                    Reject
                                                </button>
                                            </form>
                                        @endif
                                    @endif




                                    @endif

                                    @if(hasAdminPermission('application_delete'))
                                        <form action="{{ route('application.delete', $row->id) }}" method="POST" style="display:inline-block;"    onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-icon" title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @php $serial++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $data->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
</div>

@endsection

@section('css')
<style>
    .text-small{
        font-size: 11px;
    }
    .ml-3{
        margin-left:1rem; 
    }
</style>
@endsection
@section('js')
@parent
{{-- SCRIPT --}}
<script>
    const filterItems = [
        //
        {
            param: 'user',
            input_id: 'user',
            type: ''
        },
        {
            param: 'company',
            input_id: 'company',
            type: ''
        },
        {
            param: 'job',
            input_id: 'job',
            type: ''
        },
        {
            param: 'status',
            input_id: 'status',
            type: ''
        },
  

        // Add more items as needed
    ];
</script>

</script>

@endsection
