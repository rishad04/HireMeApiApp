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


</script>

@endsection
