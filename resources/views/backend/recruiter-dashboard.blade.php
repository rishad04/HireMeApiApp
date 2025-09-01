@extends('backend.partials.master')

@section('title')
Recruiter
@endsection

@section('container')
 <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">

                <div class="col-lg-12 col-md-4 order-1">
                  <div class="row">

                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <span class="fw-semibold d-block mb-1">Name: {{ auth()->guard('admin')->user()->name }}</span>
                          <span class="fw-semibold d-block mb-1">Email: {{ auth()->guard('admin')->user()->email }}</span>
                          <span class="fw-semibold d-block mb-1">Company: {{ auth()->guard('admin')->user()->company?->name }}</span>
                          <span class="fw-semibold d-block mb-1">My Company jobs: {{ $data['total_job'] }}</span>
                          <span class="fw-semibold d-block mb-1">My Company job Applicants: {{ $data['total_applicant'] }}</span>
                       
                       
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body" style="height: 185px">
                          <canvas id="companyDoughnutChart" width="300" height="150px"></canvas>
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
    const doughnutCtx = document.getElementById('companyDoughnutChart').getContext('2d');
    new Chart(doughnutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Jobs', 'Applicants'],
            datasets: [{
                data: [
                    {{ $data['total_job'] }},
                    {{ $data['total_applicant'] }}
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                ],
                hoverOffset: 10
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

@endsection
