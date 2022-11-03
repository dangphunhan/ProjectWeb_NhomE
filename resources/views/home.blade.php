@extends('layouts.main')

@section('content')

    <section class="section">
    @if($currantWorkspace)
            <h2 class="section-title">{{ __('Projects') }}</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card widget-inline">
                        <div class="card-body p-0">
                            <div class="row no-gutters">
                                <div class="col-sm-6 col-xl-3 animated">
                                    <div class="card shadow-none m-0">
                                        <div class="card-body text-center">
                                            <i class="dripicons-briefcase text-muted" style="font-size: 24px;"></i>
                                            <h3><span></span></h3>
                                            <p class="text-muted font-15 mb-0">{{ __('Total Projects') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3 animated">
                                    <div class="card shadow-none m-0 border-left">
                                        <div class="card-body text-center">
                                            <i class="dripicons-checklist text-muted" style="font-size: 24px;"></i>
                                            <h3><span></span></h3>
                                            <p class="text-muted font-15 mb-0">{{ __('Total Tasks') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3 animated">
                                    <div class="card shadow-none m-0 border-left">
                                        <div class="card-body text-center">
                                            <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                            <h3><span></span></h3>
                                            <p class="text-muted font-15 mb-0">{{ __('Members') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3 animated">
                                    <div class="card shadow-none m-0 border-left">
                                        <div class="card-body text-center">
                                            <i class="dripicons-graph-line text-muted" style="font-size: 24px;"></i>
                                            <h3><span></span></h3>
                                            <p class="text-muted font-15 mb-0">{{ __('Clients') }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end row -->
                        </div>
                    </div> <!-- end card-box-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

            <div class="row">
                <div class="col-12">
                    <div class="card animated">
                        <div class="card-header">
                            <h4>{{ __('Tasks Overview') }}</h4>
                        </div>
                        <div class="card-body">

                            <div class="mt-3 chartjs-chart" style="height: 320px;">
                                <canvas id="task-area-chart"></canvas>
                            </div>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->


            <div class="row">
                <div class="col-xl-4">
                    <div class="card animated">
                        <div class="card-header">
                            <h4>{{ __('Project Status') }}</h4>
                        </div>
                        <div class="card-body">

                            <div class="my-4 chartjs-chart" style="height: 202px;">
                                <canvas id="project-status-chart"></canvas>
                            </div>

                            <div class="row text-center mt-2 py-2">

                                @foreach($arrProcessPer as $index => $value)

                                    <div class="col-4">
                                        <i class="mdi mdi-trending-up {{$arrProcessClass[$index]}} mt-3 h3"></i>
                                        <h3 class="font-weight-normal">
                                            <span>{{$value}}%</span>
                                        </h3>
                                        <p class="text-muted mb-0">{{$arrProcessLable[$index]}}</p>
                                    </div>

                                @endforeach

                            </div>
                            <!-- end row-->

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

                <div class="col-xl-8">
                    <div class="card animated">
                        <div class="card-header">
                            <h4>{{ __('Tasks') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            </div> <!-- end table-responsive-->

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
    @endif
    </section>

@endsection
