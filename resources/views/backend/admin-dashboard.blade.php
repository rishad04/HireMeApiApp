@extends('backend.partials.master')

@section('title')
Admin
@endsection

@section('container')
 <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">

                  <div class="col-lg-12 col-md-4 order-1">
                  <div class="row">

                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <span class="fw-semibold d-block mb-1">Total Company</span>
                          <h3 class="card-title mb-2">{{ $data['total_company'] }} </h3>
                          <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <span class="fw-semibold d-block mb-1">Total Jobs</span>
                          <h3 class="card-title mb-2">{{ $data['total_job'] }}</h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <span class="fw-semibold d-block mb-1">Total Job Applications</span>
                          <h3 class="card-title mb-2">{{ $data['total_applicant'] }}</h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body"> 
                          <span class="fw-semibold d-block mb-1">Income</span>
                          <h3 class="card-title mb-2">{{ $data['total_income'] }} tk</h3>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="col-lg-12 col-md-4 order-1">
                  <div class="row">

                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <canvas id="dashboardChart" width="400" height="200"></canvas>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body" style="height: 282px">
                          <canvas id="doughnutChart" width="100" height="230px"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              


                <!--/ Transactions -->
              </div>
            </div>
            <!-- / Content -->

@endsection

@section('css')
@endsection
@section('js')
@parent
{{-- SCRIPT --}}

<script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');
    const dashboardChart = new Chart(ctx, {
        type: 'bar', // try 'doughnut' or 'pie' too
        data: {
            labels: ['Companies', 'Jobs', 'Applicants', 'Income'],
            datasets: [{
                label: 'Dashboard Overview',
                data: [
                    {{ $data['total_company'] }},
                    {{ $data['total_job'] }},
                    {{ $data['total_applicant'] }},
                    {{ $data['total_income'] }}
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(255, 99, 132, 0.6)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Doughnut Chart (excluding income)
    const doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
    new Chart(doughnutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Companies', 'Jobs', 'Applicants'],
            datasets: [{
                label: 'Distribution',
                data: [
                    {{ $data['total_company'] }},
                    {{ $data['total_job'] }},
                    {{ $data['total_applicant'] }}
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                ],
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>


</script>

@endsection
