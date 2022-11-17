@extends('layouts.main')

@section('content')
<<<<<<< HEAD
    <section class="section">
        @if ($currantWorkspace)
            <h2 class="section-title">{{ __('Dashboard') }}</h2>
=======

    <section class="section">
    @if($currantWorkspace)
            <h2 class="section-title">{{ __('Projects') }}</h2>
>>>>>>> login

            <div class="row">
                <div class="col-12">
                    <div class="card widget-inline">
                        <div class="card-body p-0">
                            <div class="row no-gutters">
<<<<<<< HEAD
                                <div class="col-sm-6 col-xl-4 animated">
                                    <div class="card shadow-none m-0">
                                        <div class="card-body text-center">
                                            <i class="dripicons-briefcase text-muted" style="font-size: 24px;"></i>
                                            <h3><span>0</span></h3>
=======
                                <div class="col-sm-6 col-xl-3 animated">
                                    <div class="card shadow-none m-0">
                                        <div class="card-body text-center">
                                            <i class="dripicons-briefcase text-muted" style="font-size: 24px;"></i>
                                            <h3><span></span></h3>
>>>>>>> login
                                            <p class="text-muted font-15 mb-0">{{ __('Total Projects') }}</p>
                                        </div>
                                    </div>
                                </div>

<<<<<<< HEAD
                                <div class="col-sm-6 col-xl-4 animated">
                                    <div class="card shadow-none m-0 border-left">
                                        <div class="card-body text-center">
                                            <i class="dripicons-checklist text-muted" style="font-size: 24px;"></i>
                                            <h3><span>0</span></h3>
=======
                                <div class="col-sm-6 col-xl-3 animated">
                                    <div class="card shadow-none m-0 border-left">
                                        <div class="card-body text-center">
                                            <i class="dripicons-checklist text-muted" style="font-size: 24px;"></i>
                                            <h3><span></span></h3>
>>>>>>> login
                                            <p class="text-muted font-15 mb-0">{{ __('Total Tasks') }}</p>
                                        </div>
                                    </div>
                                </div>

<<<<<<< HEAD
                                <div class="col-sm-6 col-xl-4 animated">
                                    <div class="card shadow-none m-0 border-left">
                                        <div class="card-body text-center">
                                            <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                            <h3><span>0</span></h3>
=======
                                <div class="col-sm-6 col-xl-3 animated">
                                    <div class="card shadow-none m-0 border-left">
                                        <div class="card-body text-center">
                                            <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                            <h3><span></span></h3>
>>>>>>> login
                                            <p class="text-muted font-15 mb-0">{{ __('Members') }}</p>
                                        </div>
                                    </div>
                                </div>

<<<<<<< HEAD
                               
=======
                                <div class="col-sm-6 col-xl-3 animated">
                                    <div class="card shadow-none m-0 border-left">
                                        <div class="card-body text-center">
                                            <i class="dripicons-graph-line text-muted" style="font-size: 24px;"></i>
                                            <h3><span></span></h3>
                                            <p class="text-muted font-15 mb-0">{{ __('Clients') }}</p>
                                        </div>
                                    </div>
                                </div>
>>>>>>> login

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
<<<<<<< HEAD
                            <h4>{{ __('Workspaces') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach (Auth::user()->workspace as $workspace)
                                    <div class="col-md-4">
                                        @if ($currantWorkspace->id == $workspace->id)
                                        <div class="card mb-0 mt-3 bg-secondary" style="height: 50px;">
                                            <a href="@if ($currantWorkspace->id == $workspace->id) #@else{{ route('change_workspace', $workspace->id) }} @endif"
                                                title="{{ $workspace->name }}">
                                                <div class="abc">
                                                    @if (isset($workspace->pivot->permission))
                                                        @if ($workspace->pivot->permission == 'Owner')
                                                            <span
                                                                class="badge badge-secondary">{{ $workspace->pivot->permission }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">{{ __('Shared') }}</span>
                                                        @endif
                                                    @endif
                                                        <i class="mdi mdi-check" style="color:green "></i>
                                                    <h5 class="ani"
                                                        style="text-align: center; color: #000; font-family: cursive">
                                                        {{ $workspace->name }}</h5>
                                                </div>
                                            </a>
                                        </div>
                                        @else
                                        <div class="card mb-0 mt-3 bg-dark" style="height: 50px;">
                                            <a href="@if ($currantWorkspace->id == $workspace->id) #@else{{ route('change_workspace', $workspace->id) }} @endif"
                                                title="{{ $workspace->name }}">
                                                <div class="abc">
                                                    @if (isset($workspace->pivot->permission))
                                                        @if ($workspace->pivot->permission == 'Owner')
                                                            <span
                                                                class="badge badge-secondary">{{ $workspace->pivot->permission }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">{{ __('Shared') }}</span>
                                                        @endif
                                                    @endif
                                                    <h5 class="ani"
                                                        style="text-align: center; color: #fff; font-family: cursive">
                                                        {{ $workspace->name }}</h5>
                                                </div>
                                            </a>
                                        </div>
                                         @endif   
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card animated">
                        <div class="card-header">
                            <h4>{{ __('Tasks') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-centered table-hover mb-0 animated">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
=======
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
>>>>>>> login
    </section>

@endsection
