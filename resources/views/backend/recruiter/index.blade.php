@extends('backend.partials.master')

@section('title')
Recruiter
@endsection

@section('container')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y mb-4">
        <div class="card ">
            <div class="d-flex justify-content-between align-items-center card-header mb-3">
                <h5 class="mb-0"> <i class='bx  bx-slider'  ></i> Recruiter</h5>
                @if(hasAdminPermission('recruiter_create'))
                <a href="{{ route($info->first_button_route) }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>
                    {{ $info->first_button_title }}
                </a>
                @endif
            </div>

            <div class="card-body">
                <div class="table-responsive text-nowrap mb-3">

                    <table class="table pb-0">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Name</th>
                                <th>company</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $serial = 1; @endphp
                            @foreach ($data as $row)
                            <tr>
                                <td>{{ $serial }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->company?->name }}</td>
                                <td class="text-nowrap">

                                    @if(hasAdminPermission('recruiter_edit'))
                                        <a href="{{ route('recruiter.edit', $row->id) }}" class="btn btn-sm btn-icon" title="Edit">
                                            <i class="bx  bx-edit-alt"></i>
                                        </a>
                                    @endif

                                    @if(hasAdminPermission('recruiter_delete'))
                                        <form action="{{ route('recruiter.delete', $row->id) }}" method="POST" style="display:inline-block;"    onsubmit="return confirm('Are you sure?')">
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
@endsection
@section('js')
@parent
{{-- SCRIPT --}}


</script>

@endsection
