@extends('admin.layouts.base')

@vite(['resources/scss/views/statistics.scss'])

@section('content')
    {{--        @dd($keys);--}}
    {{--    @dd($compactedData);--}}
    {{--    @dd($data)--}}
    <div class="mt-4 row justify-content-center align-items-center">
        <div class="col-sm-12 col-md-10 col-lg-8 col-xl-7 text-center">
            <h4 class="fw-bold">- {{ $apartment->name }} -</h4>
            <div class="row g-3 row-cols-1 row-cols-sm-auto justify-content-between">
                <div class="col d-flex gap-3 justify-content-start align-items-center">
                    <div class="d-flex">
                        <a class="ms-back-button" href="{{ route('admin.apartments.index') }}"> Back</a>
                    </div>
                    <div class="d-md-none ms-title">Views:
                        <span class="fw-bold">{{ $apartment->views->count() }}</span>
                    </div>
                    <div class="d-none d-md-block fs-6 ms-title text-nowrap"><span>Total </span> views:
                        <span class="fw-bold">{{ $apartment->views->count() }}</span>
                    </div>
                </div>
                <div class="col d-flex justify-content-between">
                    <div class="row row-cols-2">
                        <div class="col d-flex gap-2 align-items-center">
                            <label class="fw-bold" for="chartTypeSelect">Chart:</label>
                            <select id="chartTypeSelect" class="form-select">
                                <option selected value="bar">Bar</option>
                                <option value="bubble">Bubble</option>
                                <option value="line">Line</option>
                            </select>
                        </div>
                        <div class="col d-flex gap-2 justify-content-end align-items-center">
                            <label class="fw-bold" for="chartMonthSelect">Filter:</label>
                            <select id="chartMonthSelect" class="form-select">
                                <option value="all">All</option>
                                @foreach($monthsLabels as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <canvas id="myChart"></canvas>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        let chartTitle = {{ Js::from($apartment->name) }};
        let graphicType = 'bar'; // initial chart type
        let maxMonthViews = {{ JS::from($maxMonthViews) }};
        let scaleY = 10 * Math.ceil(maxMonthViews / 10) + 10;

        // Monthly
        const monthsLabels = {{ Js::from($monthsLabels) }};
        const monthValues = {{ Js::from($monthValues) }};
        // Daily
        const months = {{ JS::from($months) }};

        function getKeys(monthIndex) {
            let keys = Object.keys(months[monthIndex]);
            // set readable label
            for (let i = 0; i < keys.length; i++) {
                keys[i] = 'Day ' + keys[i];
            }
            console.log(keys);
            return keys;
        }

        function getValues(monthIndex) {
            let values = Object.values(months[monthIndex]);
            console.log(values);
            return values;
        }

        // Initialize the initial data for the chart
        let chartLabels = monthsLabels;
        let chartValues = monthValues;

        const data = {
            labels: chartLabels,
            datasets: [{
                label: 'Views',
                backgroundColor: 'rgb(72,91,161)',
                borderColor: 'rgb(72,91,161)',
                data: chartValues,
            }]
        };

        const config = {
            type: graphicType,
            data: data,
            options: {
                scales: {
                    y: {
                        min: 0,
                        max: scaleY
                    }
                },
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 0.55,
                        to: 0.5,
                        loop: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                    },
                },
                elements: {
                    bar: {
                        borderRadius: 7
                    },
                    point: {
                        hitRadius: 40,
                        hoverRadius: 10,
                        radius: 5,
                        pointStyle: 'circle'
                    }
                }
            }
        };

        // Init chart
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
        const chartTypeSelect = document.getElementById('chartTypeSelect');
        const chartMonthSelect = document.getElementById('chartMonthSelect');

        // Filter event listeners
        chartTypeSelect.addEventListener('change', (event) => {
            graphicType = event.target.value;
            myChart.config.type = graphicType;
            myChart.update();
        });
        chartMonthSelect.addEventListener('change', (event) => {
            const selectedMonth = event.target.value;
            // Filter the data based on the selected month
            if (selectedMonth === 'all') {
                // monthly chart
                chartLabels = monthsLabels;
                chartValues = monthValues;
                // Update the chart's options with the new scaleY
                scaleY = 10 * Math.ceil(maxMonthViews / 10) + 10;
                myChart.options.scales.y.max = scaleY;
            } else {
                // daily chart
                const monthIndex = monthsLabels.indexOf(selectedMonth);
                chartLabels = getKeys(monthIndex);
                chartValues = getValues(monthIndex);
                // Update the chart's options with the new scaleY
                scaleY = 10 * Math.ceil(Math.max(...chartValues) / 10);
                myChart.options.scales.y.max = scaleY;
            }
            // Update the chart's data and redraw the chart
            myChart.data.labels = chartLabels;
            myChart.data.datasets[0].data = chartValues;
            myChart.update();
        });
    </script>
@endsection
