@extends('layouts.app')
@section('title','Dashboard')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                <h1>{{trans('dashboard.Dashboard')}}</h1><br>
                <kbd>Likes activity</kbd><br><br>

                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-twitter"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">{{\App\TwitterContentList::where('userId',Auth::user()->id)->where('status','done')->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-instagram"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">{{\App\InstagramContentList::where('userId',Auth::user()->id)->where('status','done')->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red-gradient"><i class="fa fa-pinterest"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">{{\App\PinterestContentList::where('userId',Auth::user()->id)->where('status','done')->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div>



                <kbd>Queued content</kbd><br><br>

                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-twitter"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Queued</span>
                                <span class="info-box-number">{{\App\TwitterContentList::where('userId',Auth::user()->id)->where('status','pending')->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-instagram"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Queued</span>
                                <span class="info-box-number">{{\App\InstagramContentList::where('userId',Auth::user()->id)->where('status','pending')->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red-gradient"><i class="fa fa-pinterest"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Queued</span>
                                <span class="info-box-number">{{\App\PinterestContentList::where('userId',Auth::user()->id)->where('status','pending')->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div>


                <kbd>Total gathered content</kbd><br><br>

                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-twitter"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total collected Content</span>
                                <span class="info-box-number">{{\App\TwitterContentList::where('userId',Auth::user()->id)->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-instagram"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Queued</span>
                                <span class="info-box-number">{{\App\InstagramContentList::where('userId',Auth::user()->id)->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red-gradient"><i class="fa fa-pinterest"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Queued</span>
                                <span class="info-box-number">{{\App\PinterestContentList::where('userId',Auth::user()->id)->count()}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div>
            </section>


        </div>

        @include('components.footer')
    </div>
@endsection

