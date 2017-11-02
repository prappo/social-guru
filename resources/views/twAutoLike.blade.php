@extends('layouts.app')
@section('title','Twitter')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">

                {{-- block 1 start--}}
                <div class="nav-tabs-custom" style="cursor: move;">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right ui-sortable-handle">
                        <li class=""><a href="#report" data-toggle="tab" aria-expanded="false">Report</a></li>
                        <li class=""><a href="#contents" data-toggle="tab" aria-expanded="false">Contents</a></li>
                        <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li class="pull-left header"><i class="fa fa-twitter"></i> Twitter</li>
                        <li class="pull-right header">
                            @if(\App\Service::where('userId',Auth::user()->id)->value('tw') == "start")
                                <button id="btnServiceStop" class="btn btn-block toogleActivation bg-green">
                                    <i class="fa fa-stop"></i>
                                    Service running
                                    <i class="fa fa-spinner fa-spin"></i>
                                </button>
                            @else

                                <button id="btnServiceStart" class="btn btn-block toogleActivation bg-red">
                                    <i class="fa fa-play"></i>
                                    Start service
                                    {{--<i class="fa fa-spinner fa-spin"></i>--}}
                                </button>

                            @endif
                        </li>
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div style="padding:10px" class="tab-pane active" id="settings">

                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-tags"></i>
                                        <small>These are the keywords used to look for media to interact with</small>
                                    </h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                </div>

                                <div class="box-body">
                                    <div>
                                        <div>
                                            <div id="tagsSection">
                                                {{--<div class="btn-group button-tag">--}}
                                                {{--<button type="button" class="btn btn-default label-button">--}}
                                                {{--food--}}
                                                {{--</button>--}}
                                                {{--<button type="button" class="btn btn-default dropdown-toggle"--}}
                                                {{--data-toggle="dropdown" aria-expanded="false"><span--}}
                                                {{--class="caret"></span><span class="sr-only">Toggle Dropdown</span>--}}
                                                {{--</button>--}}
                                                {{--<ul class="dropdown-menu" role="menu">--}}
                                                {{--<li class="no-action"><a href="#"><i--}}
                                                {{--class="fa fa-users text-twitter"></i>--}}
                                                {{--0 conversions--}}
                                                {{--</a></li>--}}

                                                {{--<li class="divider"></li>--}}

                                                {{--<li><a href="#" class="removeTag"><i--}}
                                                {{--class="fa fa-close text-twitter"></i>--}}
                                                {{--Remove Tag--}}
                                                {{--</a></li>--}}
                                                {{--</ul>--}}
                                                {{--</div>--}}

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button class="btn btn-twitter btn-flat" id="tagBtn"><i
                                                        class="fa fa-tag"></i><!-- react-text: 25 -->
                                                <!-- /react-text --><!-- react-text: 26 -->Add Tag<!-- /react-text -->
                                                <!-- react-text: 27 --> <!-- /react-text --><!-- react-text: 28 -->
                                                <!-- /react-text --></button>
                                        </div>
                                        <input id="tagQuery" type="text" class="form-control"
                                               placeholder="Write one tag and press Add tag button" value=""></div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">

                                </div>
                                <!-- /.box-footer -->
                            </div>

                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-users"></i><!-- react-text: 153 -->Super
                                        Targeting<!-- /react-text --><!-- react-text: 154 --> <!-- /react-text -->
                                        <small>Add any user here to interact with the people who follow them</small>
                                    </h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div>
                                    <div class="box-body">
                                        <div>
                                            <div id="showFollowers">
                                                {{--<div class="btn-group button-tag">--}}
                                                {{--<button type="button" class="btn btn-default label-button"><img--}}
                                                {{--class="img-circle" width="20"--}}
                                                {{--src="https://pbs.twimg.com/profile_images/830129868373266432/a0_asx8X_normal.jpg"--}}
                                                {{--style="margin-right: 5px;"><!-- react-text: 166 -->--}}
                                                {{--travel<!-- /react-text --></button>--}}
                                                {{--<button type="button" class="btn btn-default dropdown-toggle"--}}
                                                {{--data-toggle="dropdown" aria-expanded="false"--}}
                                                {{--style="font-size: 16px;"><span class="caret"></span><span--}}
                                                {{--class="sr-only">Toggle Dropdown</span></button>--}}
                                                {{--<ul class="dropdown-menu" role="menu">--}}
                                                {{--<li class="no-action"><a href="#"><i--}}
                                                {{--class="fa fa-users text-twitter"></i>--}}
                                                {{--<!-- react-text: 174 -->2.8M<!-- /react-text -->--}}
                                                {{--<!-- react-text: 175 --> <!-- /react-text -->--}}
                                                {{--<!-- react-text: 176 -->followers<!-- /react-text -->--}}
                                                {{--</a></li>--}}
                                                {{--<li class="no-action"><a href="#"><i--}}
                                                {{--class="fa fa-user-plus text-twitter"></i>--}}
                                                {{--<!-- react-text: 180 -->0<!-- /react-text -->--}}
                                                {{--<!-- react-text: 181 --> <!-- /react-text -->--}}
                                                {{--<!-- react-text: 182 -->Likes<!-- /react-text -->--}}
                                                {{--</a></li>--}}
                                                {{--<li><a href="https://www.twitter.com/travel" target="_blank"><i--}}
                                                {{--class="fa fa-external-link text-twitter"></i>--}}
                                                {{--<!-- react-text: 186 --> Profile<!-- /react-text --></a>--}}
                                                {{--</li>--}}
                                                {{--<li class="divider"></li>--}}
                                                {{--<li><a href="#" class="removeTag"><i--}}
                                                {{--class="fa fa-close text-twitter"></i>--}}
                                                {{--<!-- react-text: 191 --> Remove User<!-- /react-text -->--}}
                                                {{--</a></li>--}}
                                                {{--</ul>--}}
                                                {{--</div>--}}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <div class="targetUserSearch">

                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-twitter btn-flat"
                                                            id="searchFollowers"><i class="fa fa-tag"></i>
                                                        <!-- react-text: 257 --> Search Users <!-- /react-text -->
                                                    </button>
                                                </div>
                                                <input type="text" id="twUserName" class="form-control"
                                                       placeholder="Search by usernames" value=""></div>

                                            <div class="suggestedTargetUsers">
                                                <div class="box-body no-padding">
                                                    <ul id="twUserList" class="users-list clearfix">

                                                        {{--<li>--}}
                                                        {{--<img src="https://pbs.twimg.com/profile_images/661903977244573696/XwtxYjX4_normal.jpg"--}}
                                                        {{--alt="User Image">--}}
                                                        {{--<a class="users-list-name" href="#">33 followers</a>--}}
                                                        {{--<button class="btn btn-success btn-xs"><i--}}
                                                        {{--class="fa fa-user-plus"></i> prappo_p--}}
                                                        {{--</button>--}}
                                                        {{--</li>--}}


                                                    </ul>
                                                    <!-- /.users-list -->
                                                </div>
                                            </div>
                                            <div class="resetSearch"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--<div class="box box-info">--}}
                            {{--<div class="box-header with-border">--}}
                            {{--<h3 class="box-title"><i class="fa fa-ban"></i><!-- react-text: 269 -->--}}
                            {{--<!-- /react-text --><!-- react-text: 270 -->Blocked Tags<!-- /react-text -->--}}
                            {{--<!-- react-text: 271 --> <!-- /react-text -->--}}
                            {{--<small>Any tag added here will prevent any interaction with any tweet/media--}}
                            {{--containing them--}}
                            {{--</small>--}}
                            {{--</h3>--}}
                            {{--<div class="box-tools pull-right">--}}
                            {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i--}}
                            {{--class="fa fa-plus"></i></button>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="box-body box-tour">--}}
                            {{--<div>--}}
                            {{--<blockquote><p>You do not have blocked tags yet.</p>--}}
                            {{--<small>Add your first one using the form below</small>--}}
                            {{--</blockquote>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="box-footer">--}}
                            {{--<form>--}}
                            {{--<div class="input-group">--}}
                            {{--<div class="input-group-btn">--}}
                            {{--<button class="btn btn-twitter btn-flat" type="submit" id="searchTags">--}}
                            {{--<i class="fa fa-tag"></i><!-- react-text: 285 -->--}}
                            {{--<!-- /react-text --><!-- react-text: 286 -->Add Negative Tag--}}
                            {{--<!-- /react-text --><!-- react-text: 287 --> <!-- /react-text -->--}}
                            {{--</button>--}}
                            {{--</div>--}}
                            {{--<input type="text" class="form-control"--}}
                            {{--placeholder="Write one keyword and press enter" value=""></div>--}}
                            {{--</form>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="box box-info">--}}
                            {{--<div class="box-header with-border">--}}
                            {{--<h3 class="box-title"><i class="fa fa-user-times"></i><!-- react-text: 295 -->--}}
                            {{--Blocked Users<!-- /react-text --><!-- react-text: 296 --> <!-- /react-text -->--}}
                            {{--<small>Add any users you do not want to interact with</small>--}}
                            {{--</h3>--}}
                            {{--<div class="box-tools pull-right">--}}
                            {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i--}}
                            {{--class="fa fa-minus"></i></button>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div>--}}
                            {{--<div class="box-body">--}}
                            {{--<div>--}}
                            {{--<div>--}}
                            {{--<blockquote><p>You do not have users yet.</p>--}}
                            {{--<small>Add your first one using the form below</small>--}}
                            {{--</blockquote>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="box-footer">--}}
                            {{--<div class="targetUserSearch">--}}
                            {{--<form>--}}
                            {{--<div class="input-group">--}}
                            {{--<div class="input-group-btn">--}}
                            {{--<button class="btn btn-twitter btn-flat" type="submit"--}}
                            {{--id="searchTags"><i class="fa fa-tag"></i>--}}
                            {{--<!-- react-text: 315 --> Search Users <!-- /react-text -->--}}
                            {{--</button>--}}
                            {{--</div>--}}
                            {{--<input type="text" class="form-control"--}}
                            {{--placeholder="Search by usernames" value=""></div>--}}
                            {{--</form>--}}
                            {{--<div class="suggestedTargetUsers">--}}
                            {{--<ul class="users-list no-height clearfix target-users-list"></ul>--}}
                            {{--</div>--}}
                            {{--<div class="resetSearch"></div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                        </div>

                        {{-- Report section --}}
                        <div class=" tab-pane" id="report">


                            <div style="padding:15px" class="row">

                                <div class="col-md-4 col-xs-12">
                                    <div class="small-box bg-instagram">
                                        <div class="inner">
                                            <h3>0</h3>
                                            <p>Today Like</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-twitter"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <div class="small-box bg-instagram">
                                        <div class="inner">
                                            <h3>0</h3>
                                            <p>Week Like</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-twitter"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <div class="small-box bg-instagram">
                                        <div class="inner">
                                            <h3>{{\App\TwitterContentList::where('userId',Auth::user()->id)->where('status','done')->count()}}</h3>
                                            <p>Total Like</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-twitter"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            {{--<div style="padding:15px" class="row">--}}


                                {{--<div class="col-lg-6 col-md-12">--}}
                                {{--<div class="col-md-12">--}}
                                {{--<h4><i class="fa fa-twitter"></i> Last Week's Conversions</h4>--}}
                                {{--<h5 class="text-center">You do not have any data yet.</h5>--}}

                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-lg-6 col-md-12">--}}
                                {{--<div class="col-md-12">--}}
                                {{--<h4><i class="fa fa-twitter"></i> Last Month's Conversions</h4>--}}
                                {{--<h5 class="text-center">You do not have any data yet.</h5>--}}

                                {{--</div>--}}
                                {{--</div>--}}


                            {{--</div>--}}
                            {{--<hr>--}}
                            <div style="padding:25px" class="row">
                                <table id="mytable" class="table table-bordered table-striped" cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>

                                        <th>Content Link</th>
                                        <th>Related Tag</th>
                                        <th>Status</th>
                                        <th>Time</th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach(\App\TwitterContentList::where('userId',Auth::user()->id)->where('status','done')->get() as $data)
                                        <tr>

                                            <td><a target="_blank"
                                                   href="{{$data->content_link}}"> {{$data->content_link}}</a></td>
                                            <td>{{$data->tag_id}}</td>

                                            <td>{{$data->status}}</td>
                                            <td>{{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</td>

                                        </tr>
                                    @endforeach

                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th>Content ID</th>
                                        <th>Content Link</th>
                                        <th>Related Tag</th>
                                        <th>Status</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>

                        <div class=" tab-pane" id="contents">
                            <div style="padding:25px" class="row">
                                <h3>Total <kbd>{{\App\TwitterContentList::where('userId',Auth::user()->id)->count()}}</kbd> contents queued</h3> <br>

                                <table id="mytable1" class="table table-bordered table-striped" cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>

                                        <th>Content Link</th>
                                        <th>Related Tag</th>
                                        <th>Status</th>
                                        <th>Timing</th>
                                        <th>Time & Date</th>


                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach(\App\TwitterContentList::where('userId',Auth::user()->id)->orderBy('id', 'DESC')->get() as $data)
                                        <tr>

                                            <td><a href="{{$data->content_link}}" target="_blank"> {{$data->content_link}}</a></td>
                                            <td>{{$data->tag_id}}</td>

                                            <td>{{$data->status}}</td>
                                            <td>{{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</td>
                                            <td>{{\Carbon\Carbon::parse($data->created_at)->toDateTimeString()}}</td>

                                        </tr>

                                    @endforeach

                                    </tbody>

                                    <tfoot>
                                    <tr>

                                        <th>Content Link</th>
                                        <th>Related Tag</th>
                                        <th>Status</th>
                                        <th>Timing</th>
                                        <th>Time & Date</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>



                    </div>
                </div>


                {{-- block 1 end--}}

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection

@section('js')
    <script>
        {{-- load tags --}}

        function getTags() {
            $.ajax({
                type: 'POST',
                url: '{{url('/twitter/tag/get')}}',
                data: {},
                success: function (data) {
                    $('#tagsSection').html(data);
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            });
        }

        getTags();
        showFollowers();


        $('#tagBtn').click(function () {
            var tagQuery = $('#tagQuery').val();
            $.ajax({
                type: 'POST',
                url: '{{url('/twitter/tag/add')}}',
                data: {
                    'tag': tagQuery
                }, success: function (data) {
                    getTags();
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            });
        });

        $('#searchFollowers').click(function () {
            var data = $('#twUserName').val();
            $('#twUserList').html("Please wait ....");
            $.ajax({
                type: 'POST',
                url: '{{url('/twitter/find/follower')}}',
                data: {
                    'data': data
                },
                success: function (data) {
                    $('#twUserList').html(data);
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            })
        });


        function showFollowers() {
            $('#showFollowers').html("Loading..");
            $.ajax({
                type: 'GET',
                url: '{{url('/twitter/followers/get')}}',
                data: {},
                success: function (data) {
                    $('#showFollowers').html(data);
                },
                error: function (data) {
                    alert("Something went wrong. Can't perform this operation");
                    console.log(data.responseText);
                }
            });
        }

        $('#btnServiceStart').click(function () {
            $.ajax({
                type: 'POST',
                url: '{{url('/service/start')}}',
                data: {
                    'type': 'tw'
                }, success: function (data) {
                    if (data == "success") {
                        location.reload();
                    } else {
                        alert("Something went wrong");
                        console.log(data);
                    }
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            });
        });

        $('#btnServiceStop').click(function () {
            $.ajax({
                type: 'POST',
                url: '{{url('/service/stop')}}',
                data: {
                    'type': 'tw'
                }, success: function (data) {
                    if (data == "success") {
                        location.reload();
                    } else {
                        alert("Something went wrong");
                        console.log(data);
                    }
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            });
        });


    </script>
@endsection
