@extends('backend.partials.master')

@section('title')
{{ $info->page_title }}
@endsection
@section('container')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y mb-4">
        <div class="row">
            <div class="col-lg-12 col-md- order-1">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 mb-4">
                        <div class="card p-3">
                            <div class="card-body d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3 p-1">
                                <!-- Mens Wear -->
                                <div class="d-flex align-items-center w-100 w-md-auto">
                                    <div class="me-2">
                                        <span class="badge bg-label-primary p-2">
                                            <i class="bx bx-dollar text-primary"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted">Mens Wear Cloths</small>
                                        <h6 class="mb-0">$32.5k</h6>
                                    </div>
                                </div>
                                <!-- Women Wear -->
                                <div class="d-flex align-items-center w-100 w-md-auto">
                                    <div class="me-2">
                                        <span class="badge bg-label-info p-2">
                                            <i class="bx bx-wallet text-info"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted">Women Wear Cloths</small>
                                        <h6 class="mb-0">$41.2k</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card ">
            <div class="d-flex justify-content-between align-items-center card-header mb-3">
                <h5 class="mb-0"> <i class='bx  bx-slider'  ></i> Cloth Types</h5>
                @can('cloth-type-create')
                <a href="{{ route($info->first_button_route) }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>
                    {{ $info->first_button_title }}
                </a>
                @endcan
            </div>

            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-5 pb-4">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="basic-addon-search31">
                                <i class="bx bx-search"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                id="search"
                                name="search"
                                placeholder="Search..."
                                aria-label="Search..."
                                value="{{ old('search', request('search')) }}"

                                aria-describedby="basic-addon-search31">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="mb-3 row">
                            <div class="col-md-12">
                                <input type="text" id="datepicker"
                                    @if (request('date_range')) value="{{ request('date_range') }}" @endif
                                    placeholder="Select Date Range">
                            </div>
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
                                <th>Title</th>
                                <th>Slug</th>
                                <th>For</th>
                                <th>Admin Profit</th>
                                <th>Washing Cost</th>
                                <th>Washing Days</th>
                                <th>Is Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $serial = 1; @endphp
                            @foreach ($data as $row)
                            <tr>
                                <td>{{ $serial }}</td>
                                <td>{{ $row->title }}</td>
                                <td>{{ $row->slug }}</td>
                                <td>{{ ucfirst($row->for) }}</td>
                                <td>
                                    {{ $row->admin_profit_type == 'amount' ? '৳' . $row->admin_profit : $row->admin_profit . '%' }}
                                </td>
                                <td>৳{{ $row->washing_cost }}</td>
                                <td>{{ $row->washing_days }} days</td>
                                <td>
                                    <div class="form-check form-switch form-switch-md">
                                        <input type="checkbox" name="is_active" value="{{ $row->id }}"
                                            onclick="toggleSwitchStatus(this,'cloth_types');" class="form-check-input"
                                            @if ($row->is_active == 1) checked @endif>
                                    </div>
                                </td>

                                <td class="text-nowrap">
                                    <a href="{{route('admin.cloths.show', $row->id)}}" class="btn btn-sm btn-icon" title="View">
                                    <i class="bx bx-show"></i>
                                    </a>

                                    <a href="{{ route('admin.cloths.edit', $row->id) }}" class="btn btn-sm btn-icon" title="Edit">
                                        <i class="bx  bx-edit-alt"></i>
                                    </a>

                                    <form action="{{ route('admin.cloths.destroy', $row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon" title="Delete">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
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
@endsection
