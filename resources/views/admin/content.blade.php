<div class="col-lg-12">
    <style>
        .small-box .icon > i {
            left: 15px;
            right: auto;
        }
    </style>
    <div class="row">
        <div class="col-md-4">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{!! \App\Models\Volunteer::query()->count() !!}</h3>

                    <p>عدد المتطوعون</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-plus"></i>
                </div>
                <p class="small-box-footer">
                    التفاصيل <i class="fas fa-arrow-circle-left"></i>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <!-- small card -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{!! $initiative !!}</h3>

                    <p>عدد الفرص التطوعية</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <a href="#" class="small-box-footer">
                    التفاصيل <i class="fas fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4">
            <!-- small card -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{!! $initiativeVolunteer !!}</h3>

                    <p>عدد المتطوعين بناء على الفرص</p>
                </div>
                <div class="icon">
                    <i class="fa fa-chart-bar"></i>
                </div>
                <h5 class="small-box-footer">
                    {!! round($avg,2) !!}
                    <i>%</i>
                </h5>
            </div>
        </div>
        <!-- ./col -->


        <!-- ./col -->
    </div>
    <!-- /.row -->

</div>

<div class="col-lg-12">

    @include('admin.chart_report')

</div>
<!-- /.col-md-6 -->
<div class="col-lg-6">
</div>

@push('scripts')

    <script src="{!! asset("design/plugins/chart/Chart.js") !!}"></script>


    @stack('script_chart')

@endpush
