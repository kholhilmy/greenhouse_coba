@extends('layouts.user_type.auth')

@section('content')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/min/moment.min.js"></script>
  <script src="https://kit.fontawesome.com/4a0d48aa7a.js" crossorigin="anonymous"></script>
  
  
  @foreach ($greenhouses as $greenhouse)

  @if(auth()->user()->id == $greenhouse->user->id)

  <div class="row mt-5 "  id="greenhouse-{{ $greenhouse->id_greenhouse }}">
    <h5 class="font-weight-bolder mb-3">
    {{$greenhouse->nama_greenhouse}}
    </h5>
    <div class="col-xl-3 col-sm-6 mb-xl-3 mb-4">
    <div class="card">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-8">
                    <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Data Suhu</p>
                        <h5 class="font-weight-bolder mb-0">
                            @if ($sensors->isNotEmpty())
                                @php
                                    // Filter sensors based on greenhouse ID
                                    $greenhouseSensors = $sensors->where('id_greenhouse', $greenhouse->id_greenhouse);
                                    $lastSensor = $greenhouseSensors->last(); // Get the last sensor data
                                    $war = 0; // Initialize temperature change percentage
                                    $pos = ""; // Initialize positive or negative symbol

                                    // Check if there are at least 2 sensor readings
                                    if ($greenhouseSensors->count() >= 2) {
                                        $oneBeforeLastSensor = $greenhouseSensors->slice(-2, 1)->first(); // Second last sensor

                                        // Ensure we have valid readings and no division by zero
                                        if ($lastSensor && $oneBeforeLastSensor && $oneBeforeLastSensor->suhu_data != 0) {
                                            // Calculate the percentage change
                                            $war = ($lastSensor->suhu_data - $oneBeforeLastSensor->suhu_data) / $oneBeforeLastSensor->suhu_data * 100;
                                        }
                                    }

                                    // Determine if the change is positive or negative
                                    $pos = ($war >= 0) ? "+" : "";
                                    
                                @endphp

                                @if ($lastSensor)
                                    <!-- Display last sensor's temperature and percentage difference -->
                                    <!-- <span class="temperature">{{ $lastSensor->suhu_data }} C</span> -->
                                    <!-- <span class="temperature-diff text-{{ $war >= 0 ? 'success' : 'danger' }} text-sm font-weight-bolder">
                                        {{ number_format($war, 4, '.', '') }} %
                                    </span> -->
                                    

                                    <span class="temperature">Loading...</span>
                                    <span class="text-success text-sm font-weight-bolder">

                                    <span class="nutrient-change">
                                      {{number_format((float)$war, 1)}} %
                                      </span>
                                    </span>
                                @else
                                    <p>No sensor data available</p>
                                @endif
                            @else
                                <p>No sensor data available</p>
                            @endif

                            
                        </h5>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="fa-duotone fa-solid fa-temperature-high fa-lg opacity-10" aria-hidden="true"></i>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Data Tinggi Air</p>
                <h5 class="font-weight-bolder mb-0">
                  34 C
                  <span class="text-success text-sm font-weight-bolder">+55%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-8">
                    <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Data Penampung Air</p>
                        <h5 class="font-weight-bolder mb-1">
                            @if ($sensors->isNotEmpty())
                                @php
                                    $greenhouseSensors = $sensors->where('id_greenhouse', $greenhouse->id_greenhouse);
                                    $lastSensor = $greenhouseSensors->last();
                                    $cok = 100; // Default value
                                    
                                    if ($lastSensor && $lastSensor->ketinggian_data != 0) {
                                        $cak = 40; // Reference height
                                        $cik = ($cak - $lastSensor->ketinggian_data);
                                        $cok = $cik / $cak * 100;
                                    }
                                @endphp
                                @if ($lastSensor)
                                <span class="water-level">Loading...</span>
                                @else
                                    <p>No sensor data available</p>
                                @endif
                            @else
                                <p>No sensor data available</p>
                            @endif
                        </h5>
                        <div class="progress-wrapper w-185 mx-auto">
                            <div class="progress-info">
                                <div class="progress-percentage">
                                    <!-- <span class="water-level text-xs font-weight-bold">
                                        @if ($sensors->isNotEmpty())
                                            {{ number_format($cok, 2) }}%
                                        @else
                                            0%
                                        @endif
                                    </span> -->
                                </div>
                            </div>
                            
                            <div class="progress">
                            @if ($sensors->isNotEmpty())
                              @if ($lastSensor)
                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="{{ $sensors->isNotEmpty() ? $cok : 0 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $sensors->isNotEmpty() ? $cok : 0 }}%;"></div>
                                @else
                                    <p></p>
                                @endif
                            @endif
                              </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="fa-solid fa-faucet-drip fa-lg text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Data Nutrisi</p>
                <h5 class="font-weight-bolder mb-0">
                @if ($sensors->isNotEmpty())
                    @php
                        $greenhouseSensors = $sensors->where('id_greenhouse', $greenhouse->id_greenhouse);
                        $lastSensor = $greenhouseSensors->last();

                        if ($greenhouseSensors->count() >= 2) {
                            $oneBeforeLastSensor = $greenhouseSensors->slice(-2, 1)->first();
                            if($lastSensor && $oneBeforeLastSensor && $oneBeforeLastSensor->tds_data != 0){
                              $war = ($lastSensor->tds_data  - $oneBeforeLastSensor->tds_data) / $oneBeforeLastSensor->tds_data * 100 ;
                            }
                            
                        } else {
                            // Handle the case where the collection has fewer than 2 items
                            $oneBeforeLastSensor = 0;
                            $war = 0;
                        }
                        
                        

                    @endphp

                  @if($lastSensor)
                    <span class="nutrient-level">Loading...</span>
                    <span class="text-success text-sm font-weight-bolder">

                    <span class="nutrient-change">
                      {{number_format((float)$war, 1)}} %
                      </span>
                    </span>
                  
                  @else

                  <p>No sensor data available</p>
                  @endif

                @else
                  <p>No sensor data available</p>
                @endif
                
                </h5>
              </div>
            </div>
            
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <!-- <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i> -->
                <i class="fa-brands fa-nutritionix fa-lg text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Data Kelembapan</p>
                <h5 class="font-weight-bolder mb-0">
                
                @if ($sensors->isNotEmpty())
                    @php
                        $greenhouseSensors = $sensors->where('id_greenhouse', $greenhouse->id_greenhouse);
                        $lastSensor = $greenhouseSensors->last();

                        if ($greenhouseSensors->count() >= 2) {
                            $oneBeforeLastSensor = $greenhouseSensors->slice(-2, 1)->first();
                            if ($lastSensor && $oneBeforeLastSensor && $oneBeforeLastSensor->kelem_data != 0) {
                              $war = ($lastSensor->kelem_data  - $oneBeforeLastSensor->kelem_data) / $oneBeforeLastSensor->kelem_data * 100 ;
                            }
                        } else {
                            // Handle the case where the collection has fewer than 2 items
                            $oneBeforeLastSensor = 0;
                            $war = 0;
                        }
                        
                        

                    @endphp
                    @if ($lastSensor)
                      <!-- Display last sensor's  -->
                      <span class="humidity-level"> Loading... </span>
                      <span class="text-success text-sm font-weight-bolder">
                    <span class="humidity-diff">
                    {{number_format((float)$war, 1)}} %
                    </span>
                  </span>
                    @else
                      <!-- Handle case where no sensor data is available -->
                      <p>No sensor data available</p>
                    @endif
                  
                  @else
                      <p>No sensor data available</p>
                  @endif
                  
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <!-- <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i> -->
                <i class="fa-solid fa-spray-can-sparkles fa-lg text-lg opacity-10"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Data Cahaya</p>
                <h5 class="font-weight-bolder mb-0">
                @if ($sensors->isNotEmpty())
                    @php
                        $greenhouseSensors = $sensors->where('id_greenhouse', $greenhouse->id_greenhouse);
                        $lastSensor = $greenhouseSensors->last();

                        if ($greenhouseSensors->count() >= 2) {
                            $oneBeforeLastSensor = $greenhouseSensors->slice(-2, 1)->first();
                            if ($lastSensor && $oneBeforeLastSensor && $oneBeforeLastSensor->cahaya_data != 0) {
                              $war = ($lastSensor->cahaya_data  - $oneBeforeLastSensor->cahaya_data) / $oneBeforeLastSensor->cahaya_data * 100 ;
                            }
                        } else {
                            // Handle the case where the collection has fewer than 2 items
                            $oneBeforeLastSensor = 0;
                            $war = 0;
                        }
                        
                        

                    @endphp
                    @if ($lastSensor)
                      <!-- Display last sensor's temperature -->
                      <span class="cahaya-level">
                      Loading...
                      </span>
                      <span class="text-success text-sm font-weight-bolder">
                    <span class="cahaya-diff">
                    {{number_format((float)$war, 2)}} %
                    </span>
                  </span>
                    @else
                      <!-- Handle case where no sensor data is available -->
                      <p>No sensor data available</p>
                    @endif
                  
                  @else
                      <p>No sensor data available</p>
                  @endif
                  
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <!-- <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i> -->
                <i class="fa-regular fa-sun fa-lg text-lg opacity-10" aria-hidden="true "></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Data PH Air</p>
                <h5 class="font-weight-bolder mb-0">
                @if ($sensors->isNotEmpty())
                    @php
                        $greenhouseSensors = $sensors->where('id_greenhouse', $greenhouse->id_greenhouse);
                        $lastSensor = $greenhouseSensors->last();

                        if ($greenhouseSensors->count() >= 2) {
                            $oneBeforeLastSensor = $greenhouseSensors->slice(-2, 1)->first();
                            if ($lastSensor && $oneBeforeLastSensor && $oneBeforeLastSensor->ph_data != 0) {
                              $war = ($lastSensor->ph_data  - $oneBeforeLastSensor->ph_data) / $oneBeforeLastSensor->ph_data * 100 ;
                            }
                        } else {
                            // Handle the case where the collection has fewer than 2 items
                            $oneBeforeLastSensor = 0;
                            $war = 0;
                        }
                        
                        

                    @endphp
                    @if ($lastSensor)
                      <!-- Display last sensor's temperature -->
                      <span class="ph-level">
                      Loading...
                      </span>
                      <span class="text-success text-sm font-weight-bolder">
                  <span class="ph-diff">
                    {{number_format((float)$war, 2)}} %
                  </span>
                  </span>
                    @else
                      <!-- Handle case where no sensor data is available -->
                      <p>No sensor data available</p>
                    @endif
                  
                  @else
                      <p>No sensor data available</p>
                  @endif

                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <!-- <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i> -->
                <i class="fa-solid fa-droplet fa-lg text-lg opacity-10" aria-hidden="true" ></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="row">
    <div class="row mt-5">
        <div class="col-xl-3 col-sm-6 mb-xl-3 mb-4">
          <div class="card">
            <div class="card-body p-3">

            <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Tombol Sistem</p>
              </div>
            </div>
            
          </div>
              <div class="form-check form-switch">
              
                      <input class="form-check-input" type="checkbox" id="mqttToggle" checked="">
                      <label class="form-check-label" for="rememberMe">OFF / ON</label>
              </div>
               <div class="numbers">
                    <p class="text-sm mb-2 text-capitalize font-weight-bold">Publish Threshold</p>
                    <button type="button" class="btn btn-primary" id="mqttButton">
                        Publish
                    </button>
                </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 

  <script>
$(document).ready(function(){
    $('#mqttToggle').change(function(){
        var isChecked = $(this).is(':checked');
        var message = isChecked ? 'ON' : 'OFF';

        $.ajax({
            url: '/mqtt/publish',
            method: 'POST',
            data: {
                topic: 'tombol/coba',
                message: message
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
            },
            error: function(response) {
                alert('Failed to publish message');
            }
        });
    });
});
</script>
  
  <!-- <div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-6">
              <div class="d-flex flex-column h-100">
                <p class="mb-1 pt-2 text-bold">Built by developers</p>
                <h5 class="font-weight-bolder">Soft UI Dashboard</h5>
                <p class="mb-5">From colors, cards, typography to complex elements, you will find the full documentation.</p>
                <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                  Read More
                  <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
              <div class="bg-gradient-primary border-radius-lg h-100">
                <img src="../assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                <div class="position-relative d-flex align-items-center justify-content-center h-100">
                  <img class="w-100 position-relative z-index-2 pt-4" src="../assets/img/illustrations/rocket-white.png" alt="rocket">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="card h-100 p-3">
        <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../assets/img/ivancik.jpg');">
          <span class="mask bg-gradient-dark"></span>
          <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
            <h5 class="text-white font-weight-bolder mb-4 pt-2">Work with the rockets</h5>
            <p class="text-white">Wealth creation is an evolutionarily recent positive-sum game. It is all about who take the opportunity first.</p>
            <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
              Read More
              <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
    </div> -->
  </div>

  <div class="row mt-5">
            <!-- Chart container for pH data -->
            <div class="col-lg-5 mb-lg-2 mb-4">
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                            <div class="chart">
                                <canvas id="chart-bars-{{ $greenhouse->id_greenhouse }}" class="chart-canvas" height="275"></canvas>
                            </div>
                        </div>
                        <h6 class="ms-2 mt-4 mb-0">Statistik Data PH</h6>
                    </div>
                </div>
            </div>

            <!-- Chart container for temperature and humidity -->
            <div class="col-lg-7 mb-4 ">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Statistik Data Suhu dan Kelembapan</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line-{{ $greenhouse->id_greenhouse }}" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart container for light data -->
            <div class="col-lg-5 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                            <div class="chart">
                                <canvas id="chart-light-{{ $greenhouse->id_greenhouse }}" class="chart-canvas" height="275"></canvas>
                            </div>
                        </div>
                        <h6 class="ms-2 mt-4 mb-0">Statistik Data Ketinggian Air</h6>
                    </div>
                </div>
            </div>

            <!-- Chart container for nutrient and water data -->
            <div class="col-lg-7">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Statistik Data Nutrisi dan Cahaya</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-nutrient-water-{{ $greenhouse->id_greenhouse }}" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


  @endif
  @endforeach
  <!-- <div class="row my-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Projects</h6>
              <p class="text-sm mb-0">
                <i class="fa fa-check text-info" aria-hidden="true"></i>
                <span class="font-weight-bold ms-1">30 done</span> this month
              </p>
            </div>
            <div class="col-lg-6 col-5 my-auto text-end">
              <div class="dropdown float-lg-end pe-4">
                <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-ellipsis-v text-secondary"></i>
                </a>
                <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                  <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Companies</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Members</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Budget</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Completion</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Soft UI XD Version</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="avatar-group mt-2">
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                        <img src="../assets/img/team-1.jpg" alt="team1">
                      </a>
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                        <img src="../assets/img/team-2.jpg" alt="team2">
                      </a>
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                        <img src="../assets/img/team-3.jpg" alt="team3">
                      </a>
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                        <img src="../assets/img/team-4.jpg" alt="team4">
                      </a>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> $14,000 </span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">60%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/small-logos/logo-atlassian.svg" class="avatar avatar-sm me-3" alt="atlassian">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Add Progress Track</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="avatar-group mt-2">
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                        <img src="../assets/img/team-2.jpg" alt="team5">
                      </a>
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                        <img src="../assets/img/team-4.jpg" alt="team6">
                      </a>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> $3,000 </span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">10%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info w-10" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/small-logos/logo-slack.svg" class="avatar avatar-sm me-3" alt="team7">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Fix Platform Errors</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="avatar-group mt-2">
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                        <img src="../assets/img/team-3.jpg" alt="team8">
                      </a>
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                        <img src="../assets/img/team-1.jpg" alt="team9">
                      </a>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> Not set </span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">100%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm me-3" alt="spotify">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Launch our Mobile App</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="avatar-group mt-2">
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                        <img src="../assets/img/team-4.jpg" alt="user1">
                      </a>
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                        <img src="../assets/img/team-3.jpg" alt="user2">
                      </a>
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                        <img src="../assets/img/team-4.jpg" alt="user3">
                      </a>
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                        <img src="../assets/img/team-1.jpg" alt="user4">
                      </a>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> $20,500 </span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">100%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm me-3" alt="jira">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Add the New Pricing Page</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="avatar-group mt-2">
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                        <img src="../assets/img/team-4.jpg" alt="user5">
                      </a>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> $500 </span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">25%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="25"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/small-logos/logo-invision.svg" class="avatar avatar-sm me-3" alt="invision">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Redesign New Online Shop</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="avatar-group mt-2">
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                        <img src="../assets/img/team-1.jpg" alt="user6">
                      </a>
                      <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                        <img src="../assets/img/team-4.jpg" alt="user7">
                      </a>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> $2,000 </span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">40%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info w-40" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card h-100">
        <div class="card-header pb-0">
          <h6>Orders overview</h6>
          <p class="text-sm">
            <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
            <span class="font-weight-bold">24%</span> this month
          </p>
        </div>
        <div class="card-body p-3">
          <div class="timeline timeline-one-side">
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="ni ni-bell-55 text-success text-gradient"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="ni ni-html5 text-danger text-gradient"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="ni ni-cart text-info text-gradient"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="ni ni-credit-card text-warning text-gradient"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order #4395133</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
              </div>
            </div>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="ni ni-key-25 text-primary text-gradient"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
              </div>
            </div>
            <div class="timeline-block">
              <span class="timeline-step">
                <i class="ni ni-money-coins text-dark text-gradient"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">New order #9583120</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->


@endsection

@push('dashboard')

<!-- <script>
    // Function to fetch sensor data via AJAX
    function fetchSensorData() {
        $.ajax({
            url: "{{ route('getSensorData') }}", // Your route to fetch sensor data
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.length > 0) {
                    let sensorData = response[0]; // Latest sensor data
                    let previousSensorData = response[1]; // Second latest sensor data for comparison
                    
                    // Update the temperature
                    $('.temperature').text(sensorData.suhu_data + '°C');

                    // Calculate the temperature difference
                    let tempDiff = (sensorData.suhu_data - previousSensorData.suhu_data)/previousSensorData.suhu_data*100;
                    let tempDiffClass = tempDiff >= 0 ? 'text-success' : 'text-danger'; // Determine if it's positive or negative
                    
                    // Update the temperature difference in percentage
                    $('.temperature-diff').html(
                        `<small class="${tempDiffClass} fw-semibold">
                        <i class="bx bx-${tempDiff >= 0 ? 'up' : 'down'}-arrow-alt"></i> ${tempDiff >= 0 ? '+' : ''} ${tempDiff.toFixed(2)} %</small>`
                    );

                    // Update water level
                    
                    let waterLevel = (40 - sensorData.ketinggian_data) / 40 * 100;
                    $('.water-level').text(waterLevel.toFixed(2) + '%');
                    $('.water-level-percentage').text(waterLevel.toFixed(2) + '%');
                    $('.progress-bar').css('width', waterLevel.toFixed(2) + '%');

                    // Update nutrient data
                    let lastNutrientSensor = sensorData.tds_data;
                    let previousNutrientSensor = previousSensorData.tds_data;
                    let nutrientLevel = lastNutrientSensor;
                    let nutrientChange = (nutrientLevel - previousNutrientSensor) / previousNutrientSensor * 100;

                    $('.nutrient-level').text(nutrientLevel + ' ppm');
                    $('.nutrient-change').html(`<small class="${nutrientChange >= 0 ? 'text-success' : 'text-danger'} fw-semibold">
                        ${nutrientChange >= 0 ? '+' : ''}${nutrientChange.toFixed(2)} %
                        </small>`);

                    // Update Kelembapan
                    let latestHumiditySensor = sensorData.kelem_data;
                    let previousHumiditySensor = previousSensorData.kelem_data;
                    let humidityChange = (latestHumiditySensor - previousHumiditySensor) / previousHumiditySensor * 100;

                    $('.humidity-level').text(latestHumiditySensor + ' %');
                    $('.humidity-diff').html(`<small class="${humidityChange >= 0 ? 'text-success' : 'text-danger'} fw-semibold">
                        ${humidityChange >= 0 ? '+' : ''}${humidityChange.toFixed(2)} %
                        </small>`);

                    // Update Cahaya
                    let latestCahayaSensor = sensorData.cahaya_data;
                    let previousCahayaSensor = previousSensorData.cahaya_data;
                    let cahayaChange = (latestCahayaSensor - previousCahayaSensor) / previousCahayaSensor * 100;

                    $('.cahaya-level').text(latestCahayaSensor + ' lux');
                    $('.cahaya-diff').html(`<small class="${cahayaChange >= 0 ? 'text-success' : 'text-danger'} fw-semibold">
                        ${cahayaChange >= 0 ? '+' : ''}${cahayaChange.toFixed(2)} %
                    </small>`);

                    // Update PH Air
                    let latestPhSensor = sensorData.ph_data;
                    let previousPhSensor = previousSensorData.ph_data;
                    let phChange = (latestPhSensor - previousPhSensor) / previousPhSensor * 100;

                    $('.ph-level').text(latestPhSensor);
                    $('.ph-diff').html(`<small class="${phChange >= 0 ? 'text-success' : 'text-danger'} fw-semibold">
                        ${phChange >= 0 ? '+' : ''}${phChange.toFixed(2)} %
                    </small>`);
                }
            },
            error: function(xhr) {
                console.log('Error fetching sensor data:', xhr);
            }
        });
    }

    // Call the function to fetch data every 5 seconds
    setInterval(fetchSensorData, 10000);
</script> -->

<script>
    function fetchSensorData() {
        $.ajax({
            url: "{{ route('getSensorData') }}",
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response); // Debug: check the structure of the response

                let greenhouseTongData = {};

                response.greenhouse.forEach(function(greenhouse) {
                    let greenhouseId = greenhouse.id_greenhouse;
                    greenhouseTongData[greenhouse.id_greenhouse] = greenhouse.tong;

                    // Now you can update the DOM or perform other actions with the greenhouse data
                    // console.log(greenhouse.tong); // Example: Display greenhouse name
                    

                    // Example of updating some DOM element with greenhouse name
                    $(`#greenhouse-${greenhouseId} .tong`).text(greenhouse.tong);
                });

                let idGreenhouse = 4; // Contoh id_greenhouse yang ingin diambil
                let tong = greenhouseTongData[idGreenhouse];

                console.log("Tong untuk greenhouse dengan id " + idGreenhouse + ": " + tong);
                // Loop through each greenhouse's sensor data
                response.sensors.forEach(function(sensorData) {
                    let greenhouseId = sensorData.id_greenhouse;
                    

                    // Update temperature
                    $(`#greenhouse-${greenhouseId} .temperature`).text(sensorData.suhu_data + '°C');

                    // Update water level
                    if (sensorData.ketinggian_data !== null) {
                        let datatong = greenhouseTongData[greenhouseId];
                        let waterLevel = (datatong - sensorData.ketinggian_data) / datatong * 100;
                        $(`#greenhouse-${greenhouseId} .water-level`).text(waterLevel.toFixed(2) + '%');
                    }

                    // Update nutrient level
                    if (sensorData.tds_data !== null) {
                        $(`#greenhouse-${greenhouseId} .nutrient-level`).text(sensorData.tds_data + ' ppm');
                    }

                    // Update humidity
                    if (sensorData.kelem_data !== null) {
                        $(`#greenhouse-${greenhouseId} .humidity-level`).text(sensorData.kelem_data + ' %');
                    }

                    // Update light level
                    if (sensorData.cahaya_data !== null) {
                        $(`#greenhouse-${greenhouseId} .cahaya-level`).text(sensorData.cahaya_data + ' lux');
                    }

                    // Update pH level
                    if (sensorData.ph_data !== null) {
                        $(`#greenhouse-${greenhouseId} .ph-level`).text(sensorData.ph_data);
                    }
                });
            },
            error: function(xhr) {
                console.log('Error fetching sensor data:', xhr);
            }
        });
    }

    // Call the function to fetch data every 10 seconds
    setInterval(fetchSensorData, 10000);
</script>


<script>
    $(document).ready(function() {
        function fetchDataAndUpdateCharts() {
            $.ajax({
                url: "{{ route('getSensorData2') }}",
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Loop through each greenhouse's data
                    Object.keys(data).forEach(function(greenhouseId) {
                        let greenhouseData = data[greenhouseId];

                        // Prepare data for charts
                        let labels = greenhouseData.map(sensor => moment(sensor.created_at).format('YYYY-MM-DD HH:mm:ss'));
                        let phData = greenhouseData.map(sensor => sensor.ph_data);
                        let temperatureData = greenhouseData.map(sensor => sensor.suhu_data);
                        let humidityData = greenhouseData.map(sensor => sensor.kelem_data);
                        let lightData = greenhouseData.map(sensor => sensor.cahaya_data);
                        let nutrientData = greenhouseData.map(sensor => sensor.tds_data);
                        let waterLevelData = greenhouseData.map(sensor => sensor.ketinggian_data);

                        // Chart for pH data
                        let ctx = document.getElementById(`chart-bars-${greenhouseId}`).getContext("2d");
                        if (window[`myBarChart${greenhouseId}`]) {
                            window[`myBarChart${greenhouseId}`].destroy();
                        }
                        window[`myBarChart${greenhouseId}`] = new Chart(ctx, {
                            type: "bar",
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: "Data Ph",
                                    backgroundColor: "#fff",
                                    data: phData,
                                    maxBarThickness: 6
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false,
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: { color: "#fff" }
                                    },
                                    x: {
                                        ticks: { color: "#fff" }
                                    }
                                }
                            }
                        });

                        // Chart for temperature and humidity
                        let ctx2 = document.getElementById(`chart-line-${greenhouseId}`).getContext("2d");
                        if (window[`myLineChart${greenhouseId}`]) {
                            window[`myLineChart${greenhouseId}`].destroy();
                        }
                        window[`myLineChart${greenhouseId}`] = new Chart(ctx2, {
                            type: "line",
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: "Suhu",
                                    borderColor: "#cb0c9f",
                                    backgroundColor: "rgba(203,12,159,0.2)",
                                    data: temperatureData,
                                    fill: true
                                },
                                {
                                    label: "Kelembapan",
                                    borderColor: "#3A416F",
                                    backgroundColor: "rgba(20,23,39,0.2)",
                                    data: humidityData,
                                    fill: true
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: true,
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: { color: "#b2b9bf" }
                                    },
                                    x: {
                                        ticks: { color: "#b2b9bf" }
                                    }
                                }
                            }
                        });

                        // Chart for light data
                        let ctx3 = document.getElementById(`chart-light-${greenhouseId}`).getContext("2d");
                        if (window[`myLightChart${greenhouseId}`]) {
                            window[`myLightChart${greenhouseId}`].destroy();
                        }
                        window[`myLightChart${greenhouseId}`] = new Chart(ctx3, {
                            type: "bar",
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: "Data Ketinggian Air",
                                    backgroundColor: "#FFD700",
                                    data: waterLevelData,
                                    maxBarThickness: 6
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false,
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: { color: "#fff" }
                                    },
                                    x: {
                                        ticks: { color: "#fff" }
                                    }
                                }
                            }
                        });

                        // Chart for nutrient and water level
                        let ctx4 = document.getElementById(`chart-nutrient-water-${greenhouseId}`).getContext("2d");
                        if (window[`myNutrientWaterChart${greenhouseId}`]) {
                            window[`myNutrientWaterChart${greenhouseId}`].destroy();
                        }
                        window[`myNutrientWaterChart${greenhouseId}`] = new Chart(ctx4, {
                            type: "line",
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: "Nutrisi",
                                    borderColor: "#0d6efd",
                                    backgroundColor: "rgba(13,110,253,0.2)",
                                    data: nutrientData,
                                    fill: true
                                },
                                {
                                    label: "Cahaya",
                                    borderColor: "#198754",
                                    backgroundColor: "rgba(25,135,84,0.2)",
                                    data: lightData,
                                    fill: true
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: true,
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: { color: "#b2b9bf" }
                                    },
                                    x: {
                                        ticks: { color: "#b2b9bf" }
                                    }
                                }
                            }
                        });
                    });
                },
                error: function(xhr) {
                    console.log('Error fetching sensor data:', xhr);
                }
            });
        }

        fetchDataAndUpdateCharts();
        setInterval(fetchDataAndUpdateCharts, 15000);
    });
</script>


<!-- <script>
        $(document).ready(function() {
          function fetchDataAndUpdateCharts() {
            $.ajax({
                url: '/sensors-data2',
                method: 'GET',
                success: function(data) {
                    var ctx = document.getElementById("chart-bars").getContext("2d");
                    if (window.myBarChart) {
                        window.myBarChart.destroy();
                    }
                    
                    window.myBarChart = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels:data.map(sensor => {
                            return moment(sensor.created_at).format('YYYY-MM-DD HH:mm:ss');}),
                            datasets: [{
                                label: "Data Ph",
                                tension: 0.4,
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                                backgroundColor: "#fff",
                                data: data.map(sensor => sensor.ph_data),
                                maxBarThickness: 6
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false,
                                }
                            },
                            interaction: {
                                intersect: false,
                                mode: 'index',
                            },
                            scales: {
                                y: {
                                    grid: {
                                        drawBorder: false,
                                        display: false,
                                        drawOnChartArea: false,
                                        drawTicks: false,
                                    },
                                    ticks: {
                                        suggestedMin: 0,
                                        suggestedMax: 500,
                                        beginAtZero: true,
                                        padding: 15,
                                        font: {
                                            size: 14,
                                            family: "Open Sans",
                                            style: 'normal',
                                            lineHeight: 2
                                        },
                                        color: "#fff"
                                    },
                                },
                                x: {
                                    grid: {
                                        drawBorder: false,
                                        display: false,
                                        drawOnChartArea: false,
                                        drawTicks: false
                                    },
                                    ticks: {
                                        display: false
                                    },
                                },
                            },
                        },
                    });

                    var ctx4 = document.getElementById("chart-bars2").getContext("2d");
                    if (window.myBarChart2) {
                        window.myBarChart2.destroy();
                    }
                    
                    window.myBarChart2 = new Chart(ctx4, {
                        type: "bar",
                        data: {
                            labels: data.map(sensor => {
                            return moment(sensor.created_at).format('YYYY-MM-DD HH:mm:ss');}),
                            datasets: [{
                                label: "Data Air",
                                tension: 0.4,
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                                backgroundColor: "#fff",
                                data: data.map(sensor => sensor.ketinggian_data),
                                maxBarThickness: 6
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false,
                                }
                            },
                            interaction: {
                                intersect: false,
                                mode: 'index',
                            },
                            scales: {
                                y: {
                                    grid: {
                                        drawBorder: false,
                                        display: false,
                                        drawOnChartArea: false,
                                        drawTicks: false,
                                    },
                                    ticks: {
                                        suggestedMin: 0,
                                        suggestedMax: 500,
                                        beginAtZero: true,
                                        padding: 15,
                                        font: {
                                            size: 14,
                                            family: "Open Sans",
                                            style: 'normal',
                                            lineHeight: 2
                                        },
                                        color: "#fff"
                                    },
                                },
                                x: {
                                    grid: {
                                        drawBorder: false,
                                        display: false,
                                        drawOnChartArea: false,
                                        drawTicks: false
                                    },
                                    ticks: {
                                        display: false
                                    },
                                },
                            },
                        },
                    });

                    var ctx2 = document.getElementById("chart-line").getContext("2d");
                    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
                    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
                    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
                    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

                    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
                    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
                    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
                    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

                    if (window.myBarChart3) {
                        window.myBarChart3.destroy();
                    }
                    window.myBarChart3 = new Chart(ctx2, {
                        type: "line",
                        data: {
                            labels: data.map(sensor => {
                            return moment(sensor.created_at).format('YYYY-MM-DD HH:mm:ss');}),
                            datasets: [{
                                label: "Kelembapan",
                                tension: 0.4,
                                borderWidth: 0,
                                pointRadius: 0,
                                borderColor: "#cb0c9f",
                                borderWidth: 3,
                                backgroundColor: gradientStroke1,
                                fill: true,
                                data: data.map(sensor => sensor.kelem_data),
                                maxBarThickness: 6
                            },
                            {
                                label: "Suhu",
                                tension: 0.4,
                                borderWidth: 0,
                                pointRadius: 0,
                                borderColor: "#3A416F",
                                borderWidth: 3,
                                backgroundColor: gradientStroke2,
                                fill: true,
                                data: data.map(sensor => sensor.suhu_data),
                                maxBarThickness: 6
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false,
                                }
                            },
                            interaction: {
                                intersect: false,
                                mode: 'index',
                            },
                            scales: {
                                y: {
                                    grid: {
                                        drawBorder: false,
                                        display: true,
                                        drawOnChartArea: true,
                                        drawTicks: false,
                                        borderDash: [5, 5]
                                    },
                                    ticks: {
                                        display: true,
                                        padding: 10,
                                        color: '#b2b9bf',
                                        font: {
                                            size: 11,
                                            family: "Open Sans",
                                            style: 'normal',
                                            lineHeight: 2
                                        },
                                    }
                                },
                                x: {
                                    grid: {
                                        drawBorder: false,
                                        display: false,
                                        drawOnChartArea: false,
                                        drawTicks: false,
                                        borderDash: [5, 5]
                                    },
                                    ticks: {
                                        display: true,
                                        color: '#b2b9bf',
                                        padding: 20,
                                        font: {
                                            size: 11,
                                            family: "Open Sans",
                                            style: 'normal',
                                            lineHeight: 2
                                        },
                                    }
                                },
                            },
                        },
                    });

                    var ctx3 = document.getElementById("chart-line2").getContext("2d");
                    var gradientStroke2 = ctx3.createLinearGradient(0, 230, 0, 50);
                    gradientStroke2.addColorStop(1, 'rgba(203,12,159,0.2)');
                    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
                    gradientStroke2.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

                    var gradientStroke3 = ctx3.createLinearGradient(0, 230, 0, 50);
                    gradientStroke3.addColorStop(1, 'rgba(20,23,39,0.2)');
                    gradientStroke3.addColorStop(0.2, 'rgba(72,72,176,0.0)');
                    gradientStroke3.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

                    if (window.myBarChart4) {
                        window.myBarChart4.destroy();
                    }
                    window.myBarChart4 = new Chart(ctx3, {
                        type: "line",
                        data: {
                            labels: data.map(sensor => {
                            return moment(sensor.created_at).format('YYYY-MM-DD HH:mm:ss');}),
                            datasets: [{
                                label: "Nutrisi",
                                tension: 0.4,
                                borderWidth: 0,
                                pointRadius: 0,
                                borderColor: "#cb0c9f",
                                borderWidth: 3,
                                backgroundColor: gradientStroke1,
                                fill: true,
                                data: data.map(sensor => sensor.tds_data),
                                maxBarThickness: 6
                            },
                            {
                                label: "Cahaya",
                                tension: 0.4,
                                borderWidth: 0,
                                pointRadius: 0,
                                borderColor: "#3A416F",
                                borderWidth: 3,
                                backgroundColor: gradientStroke2,
                                fill: true,
                                data: data.map(sensor => sensor.cahaya_data),
                                maxBarThickness: 6
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false,
                                }
                            },
                            interaction: {
                                intersect: false,
                                mode: 'index',
                            },
                            scales: {
                                y: {
                                    grid: {
                                        drawBorder: false,
                                        display: true,
                                        drawOnChartArea: true,
                                        drawTicks: false,
                                        borderDash: [5, 5]
                                    },
                                    ticks: {
                                        display: true,
                                        padding: 10,
                                        color: '#b2b9bf',
                                        font: {
                                            size: 11,
                                            family: "Open Sans",
                                            style: 'normal',
                                            lineHeight: 2
                                        },
                                    }
                                },
                                x: {
                                    grid: {
                                        drawBorder: false,
                                        display: false,
                                        drawOnChartArea: false,
                                        drawTicks: false,
                                        borderDash: [5, 5]
                                    },
                                    ticks: {
                                        display: true,
                                        color: '#b2b9bf',
                                        padding: 20,
                                        font: {
                                            size: 11,
                                            family: "Open Sans",
                                            style: 'normal',
                                            lineHeight: 2
                                        },
                                    }
                                },
                            },
                        },
                    });
                }
            });
          }
          fetchDataAndUpdateCharts();
          setInterval(fetchDataAndUpdateCharts, 15000);
        });
    </script> -->
@endpush



