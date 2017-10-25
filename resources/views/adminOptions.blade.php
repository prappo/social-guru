@extends('layouts.app')
@section('title','Admin Options | Optimus')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="box box-primary">
                        <div class="box-header with-border" align="center">
                            <h3 class="box-title"><i class="fa fa-clock-o"></i> Schedule settings ( Cron Job )</h3>
                        </div>

                        <div class="box-body">
                            <h3><i class="fa fa-calender"></i> Schedule</h3>

                            <div class="well">
                                <code>
                                    * * * * * curl {{url('/schedule/fire')}}
                                </code>
                            </div>
                            <h3><i class="fa fa-instagram"></i> Instagram </h3>
                            <div class="well">
                                <code>
                                    * * * * * curl {{url('/service/instagram')}}
                                </code>
                            </div>

                            <div class="well">
                                <code>
                                    * * * * * curl {{url('/robot/instagram')}}
                                </code>
                            </div>


                            <h3><i class="fa fa-twitter"></i> Twitter </h3>
                            <div class="well">
                                <code>
                                    * * * * * curl {{url('/service/twitter')}}
                                </code>
                            </div>

                            <div class="well">
                                <code>
                                    * * * * * curl {{url('/robot/twitter')}}
                                </code>
                            </div>
                        </div>
                    </div>

                </div>


            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('css')
    <style>
        .row {
            margin: 5px;
        }
    </style>
@endsection
