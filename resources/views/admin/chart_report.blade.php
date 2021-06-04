@push('css')
    <style>
        .card-header > .card-tools{
            float: left;
        }
    </style>
@endpush
<div class="card card-gray-dark">
    <div class="card-header">
        <h3 class="card-title">الفرص التطوعية</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
    <!-- /.card-body -->
</div>

@push('script_chart')
    <script>
        var c,i = 0

        $(function () {
            // setInterval(aja,3000)
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var areaChartData = {
                labels  : [
                    '{!! $initiatives_name[0] !!}',
                    '{!! $initiatives_name[1] !!}',
                    '{!! $initiatives_name[2] !!}',
                    '{!! $initiatives_name[3] !!}',
                    '{!! $initiatives_name[4] !!}',
                    '{!! $initiatives_name[5] !!}',
                    '{!! $initiatives_name[6] !!}',
                ],
                datasets: [
                    {
                        label               : 'تم قبول المبادرة',
                        backgroundColor     : 'rgba(60,188,73,0.9)',
                        borderColor         : 'rgba(60,188,73,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,188,73,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,188,73,1)',
                        data                : [
                            {!! $isAccept[0] !!},
                            {!! $isAccept[1] !!},
                            {!! $isAccept[2] !!},
                            {!! $isAccept[3] !!},
                            {!! $isAccept[4] !!},
                            {!! $isAccept[5] !!},
                            {!! $isAccept[6] !!},
                        ]
                    },
                    {
                        label               : 'العدد الكلي للمتطوعين',
                        backgroundColor     : 'rgba(210, 214, 222, 1)',
                        borderColor         : 'rgba(210, 214, 222, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : [
                            {!! $cnt_volunteer[0] !!},
                            {!! $cnt_volunteer[1] !!},
                            {!! $cnt_volunteer[2] !!},
                            {!! $cnt_volunteer[3] !!},
                            {!! $cnt_volunteer[4] !!},
                            {!! $cnt_volunteer[5] !!},
                            {!! $cnt_volunteer[6] !!},
                        ]
                    },
                    {
                        label               : 'تم القبول (ذكور)',
                        backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : [
                            {!! $male[0] !!},
                            {!! $male[1] !!},
                            {!! $male[2] !!},
                            {!! $male[3] !!},
                            {!! $male[4] !!},
                            {!! $male[5] !!},
                            {!! $male[6] !!},
                        ]
                    },
                    {
                        label               : 'تم القبول (إناث)',
                        backgroundColor     : 'rgba(154,60,188,0.9)',
                        borderColor         : 'rgba(154,60,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#9e3bba',
                        pointStrokeColor    : 'rgba(154,60,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(154,60,188,1)',
                        data                : [
                            {!! $female[0] !!},
                            {!! $female[1] !!},
                            {!! $female[2] !!},
                            {!! $female[3] !!},
                            {!! $female[4] !!},
                            {!! $female[5] !!},
                            {!! $female[6] !!},
                        ]
                    },
                ]
            }
            var barChartData = jQuery.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false
            }

            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        })
        function aja(){

            $.ajax({
                url:'{!! url('init/chart') !!}',
                type:'get',
                data_type:'json',
                data: {_token:'{!! csrf_token() !!}'},
                success:function (data) {
                    if (data.cnt !== c || data.isAccept !== i){
                        $('.chart-card').removeClass('collapsed-card')
                        $('.chart-title').text(data.name)
                        c = data.cnt
                        i = data.isAccept
                        chart(c,i)
                    }
                },
                error:function (){
                    alert("لم يتم الارسال نرجوا المحاولة مرة أخرى")
                }
            })
            return false
        }

        function chart(c,i){
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false
            }

            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        }
    </script>
@endpush
