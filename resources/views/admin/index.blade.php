@extends('layouts.main')
@section('content')
@section('title', 'Dashboard')
<h3 class="text-center fw-bold">Dashboard</h3>
<div class="mb-3">
    <div class="row row-cols-1 row-cols-lg-2 g-3">
        <div class="col">
            <div class="text-center d-flex justify-content-center shadow p-3 rounded-3">
                <div class="bg-light container h5">
                    <div class="h4 fw-bold">Current time</div>
                    <div id="clock"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="text-center shadow p-3 rounded-3">
                <div class="bg-light container h5">
                    <div class="h4 fw-bold">Current date</div>
                    <div id="date"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row row-cols-1 row-cols-lg-2 g-3">
    <div class="col">
        <div class="text-center shadow rounded-3 p-3">
            <h5 class="fw-bold">Rented / Available (rooms)</h5>
            <canvas id="pieChart" class="mb-3 w-25 h-25 mx-auto"></canvas>
            <div><b>Total rooms</b>: <b>{{ $countAll }}</b> rooms</div>
            <div><b style="color: #fc6484;">Rented rooms</b>: {{ number_format((float) $percentRented, 0) }}%
                (<b>{{ $countRented }}</b>
                rooms)
            </div>
            <div><b style="color:#34a4ec;">Available rooms</b>: {{ number_format((float) $percentAvailable, 0) }}%
                (<b>{{ $countAvailable }}</b>
                rooms)</div>
        </div>
    </div>
    <div class="col">
        <div class="text-center shadow rounded-3 p-3">
            <h5 class="fw-bold">Rooms rented per month (rooms)</h5>
            <canvas id="lineChart" class="mb-3 mx-auto w-75 h-75"></canvas>
            <div>Year: <b>
                    <?php echo date('Y'); ?>
                </b></div>
        </div>
    </div>
</div>

@section('js')
    @if (session('notify') == 'Login success')
        <script>
            Swal.fire({
                title: 'Welcome back',
                text: "{{ Auth::user()->fullname }}",
                icon: 'success',
                timer: 2000,
                showConfirmButton: false,
                allowOutsideClick: false,
            })
        </script>
    @endif
    <script type="text/javascript">
        var ctx = document.getElementById("pieChart").getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Available', 'Rented'],
                datasets: [{
                    data: [{{ $countAvailable }}, {{ $countRented }}],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    resposive: true,
                    legend: {
                        display: false,
                    }
                }
            }
        });
    </script>
    <script type="text/javascript">
        var ctx = document.getElementById("lineChart").getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                datasets: [{
                    label: 'Rooms',
                    data: [{{ $countRentMonth1 }}, {{ $countRentMonth2 }}, {{ $countRentMonth3 }},
                        {{ $countRentMonth4 }}, {{ $countRentMonth5 }}, {{ $countRentMonth6 }},
                        {{ $countRentMonth7 }}, {{ $countRentMonth8 }}, {{ $countRentMonth9 }},
                        {{ $countRentMonth10 }}, {{ $countRentMonth11 }}, {{ $countRentMonth12 }}
                    ],
                    borderColor: 'rgba(0,0,255)',
                }],
            },
            options: {
                plugins: {
                    resposive: true,
                    legend: {
                        display: false,
                    }
                }
            }
        });
    </script>
    <script>
        function currentTime() {
            let date = new Date();
            let hh = date.getHours();
            let mm = date.getMinutes();
            let ss = date.getSeconds();
            let session = "AM";


            if (hh > 12) {
                session = "PM";
            }

            hh = (hh < 10) ? "0" + hh : hh;
            mm = (mm < 10) ? "0" + mm : mm;
            ss = (ss < 10) ? "0" + ss : ss;

            let time = hh + ":" + mm + ":" + ss + " " + session;
            let currentDate = new Date().toLocaleDateString();
            document.getElementById("clock").innerText = time;
            document.getElementById("date").innerText = currentDate;
            var t = setTimeout(function() {
                currentTime()
            }, 1000);

        }

        currentTime();
    </script>
@endsection
@endsection
