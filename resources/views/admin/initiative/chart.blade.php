
<div class="card sidebar-dark chart-card collapsed-card">
    <div class="card-header">
        <h3 class="card-title chart-title"></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <canvas id="donutChart" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
    </div>
    <!-- /.card-body -->
</div>

@push('script_chart')
<script>
    var c,i = 0

    $(function () {
        setInterval(aja,3000)
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
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData        = {
            labels: [
                'الاجمالي',
                'تم القبول',
            ],
            datasets: [
                {
                    data: [c,i],
                    backgroundColor : ['#7a7979', '#00a65a'],
                }
            ]
        }
        var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
        }
        var donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    }
</script>
@endpush
