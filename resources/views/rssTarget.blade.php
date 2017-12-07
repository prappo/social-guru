@extends('layouts.app')
@section('title','Add Target RSS Sites')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-rss"></i> RSS Target site</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">

                        @if(\App\Service::where('userId',Auth::user()->id)->value('rss') == "start")
                            <button id="btnServiceStop" class="btn  toogleActivation bg-green">
                                <i class="fa fa-stop"></i>
                                Service running
                                <i class="fa fa-spinner fa-spin"></i>
                            </button>
                        @else

                            <button id="btnServiceStart" class="btn  toogleActivation bg-red">
                                <i class="fa fa-play"></i>
                                Start service
                                {{--<i class="fa fa-spinner fa-spin"></i>--}}
                            </button>

                        @endif

                        <hr>
                        {{--<div class="input-group input-group-xs">--}}
                            {{--<input id="url" type="text" placeholder="Input your site here" class="form-control">--}}
                            {{--<span class="input-group-btn">--}}
                      {{--<button type="button" class="btn btn-info btn-flat"><i class="fa fa-globe"></i></button>--}}
                    {{--</span>--}}
                        {{--</div>--}}


                            <div class="form-group">

                                <select id="url" class="form-control">
                                    @foreach($datas as $data)
                                        <option id="{{$data->id}}">{{$data->site}}</option>
                                    @endforeach
                                </select>
                            </div>


                        <div class="box-body">
                            <div class="form-group">


                                <div class="form-group">
                                    <label>Target Social Media</label>
                                </div>
                                @if(\App\Http\Controllers\Data::myPackage('fb'))
                                    @if(!empty(\App\Http\Controllers\Data::get('fbAppId')))
                                        <div class="checkbox">
                                            <label>
                                                <input id="fb" type="checkbox">
                                                <i class="fa fa-facebook"></i> Facebook
                                            </label>
                                        </div>
                                        <div id="fbPages" style="display: none">
                                            Facebook Pages
                                            <select id="facebookPages">

                                                <option>no</option>
                                                @foreach(\App\FacebookPages::where('userId',Auth::user()->id)->get() as $fbPages)
                                                    <option id="{{$fbPages->pageId}}">{{$fbPages->pageName}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="fbGroups" style="display: none">
                                            <hr>

                                            Facebook Groups
                                            <select id="facebookGroups">
                                                <option>no</option>
                                                @foreach(\App\facebookGroups::where('userId',Auth::user()->id)->get() as $fbPages)
                                                    <option id="{{$fbPages->pageId}}">{{$fbPages->pageName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                @endif

                                @if(\App\Http\Controllers\Data::myPackage('tw'))
                                    @if(!empty(\App\Http\Controllers\Data::get('twTokenSec')))
                                        <div class="checkbox">
                                            <label>
                                                <input id="tw" type="checkbox">
                                                <i class="fa fa-twitter"></i> Twitter
                                            </label>
                                        </div>

                                    @endif
                                @endif

                                @if(\App\Http\Controllers\Data::myPackage('ln'))

                                    @if(!empty(\App\Http\Controllers\Data::get('liAccessToken')))

                                        <div class="checkbox">
                                            <label>
                                                <input id="ln" type="checkbox">
                                                <i class="fa fa-linkedin"></i> Linkedin
                                            </label>
                                        </div>

                                        <div id="liCompanySelection" style="display: none">
                                            <fieldset class="scheduler-border">
                                                Your linkedin {{ count($liCompanies) > 1 ? 'companies' : 'company' }}
                                                list

                                                <select id="liCompanies">

                                                    @if($liCompanies != "")
                                                        @foreach($liCompanies as $liCompany)
                                                            <option id="{{ $liCompany['id'] }}">{{ $liCompany['name'] }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </fieldset>
                                        </div>
                                    @endif
                                @endif

                                {{--@if(\App\Http\Controllers\Data::myPackage('in'))--}}
                                    {{--@if(!empty(\App\Http\Controllers\Data::get('inPass')))--}}
                                        {{--<div class="checkbox">--}}
                                            {{--<label>--}}
                                                {{--<input id="in" type="checkbox">--}}
                                                {{--<i class="fa fa-instagram"></i> Instagram--}}
                                            {{--</label>--}}
                                        {{--</div>--}}
                                    {{--@endif--}}
                                {{--@endif--}}


                            </div>
                            <button id="addTarget" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Add
                                Target
                            </button>

                            <hr>
                            <div style="padding:25px" class="row">
                                <table id="mytable" class="table table-bordered table-striped" cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th>Site</th>
                                        <th>FB Page</th>
                                        <th>FB Group</th>
                                        <th>Linkedin</th>
                                        <th>Twitter</th>
                                        {{--<th>Instagram</th>--}}

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach(\App\rssTarget::where('userId',Auth::user()->id)->get() as $data)
                                        <tr>
                                            <td><b>{{$data->site}}</b></td>
                                            <td align="center">
                                                @if($data->fbPageName == "no")
                                                    <i class="fa fa-close" style="color:red"></i>
                                                @else
                                                    <i class="fa fa-check" style="color: green"></i>
                                                    {{$data->fbPageName}}
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if($data->fbGroupName == "no")
                                                    <i class="fa fa-close" style="color:red"></i>
                                                @else
                                                    <i class="fa fa-check" style="color: green"></i>
                                                    {{$data->fbGroupName}}
                                                @endif
                                            </td>

                                            <td align="center">
                                                @if($data->liCompanyName == "no")
                                                    <i class="fa fa-close" style="color:red"></i>
                                                @else
                                                    <i class="fa fa-check" style="color: green"></i>
                                                    {{$data->liCompanyName}}
                                                @endif
                                            </td>

                                            <td align="center">
                                                @if($data->tw == "no")
                                                    <i class="fa fa-close" style="color:red"></i>
                                                @else
                                                    <i class="fa fa-check" style="color: green"></i>
                                                    {{$data->tw}}
                                                @endif
                                            </td>

                                            {{--<td align="center">--}}
                                                {{--@if($data->in == "no")--}}
                                                    {{--<i class="fa fa-close" style="color:red"></i>--}}
                                                {{--@else--}}
                                                    {{--<i class="fa fa-check" style="color: green"></i>--}}
                                                    {{--{{$data->in}}--}}
                                                {{--@endif--}}
                                            {{--</td>--}}


                                        </tr>

                                    @endforeach

                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th>Site</th>
                                        <th>FB Page</th>
                                        <th>FB Group</th>
                                        <th>Linkedin</th>
                                        <th>Twitter</th>
                                        {{--<th>Instagram</th>--}}
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>

                    <!-- /.box-body -->


                </div>


            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('js')
    <script>

        var fbPageId = "no", fbPageName = "no", fbGroupId = "no", fbGroupName = "no", tw = "no", instagram = "no", liCompanyId = "no", liCompanyName = "no";
        $('#fbPages').hide();
        $('#fbGroups').hide();


        {{--$('#addSite').click(function () {--}}
            {{--$('#addSite').html('<i class="fa fa-globe"></i> Please Wait ....');--}}
            {{--$.ajax({--}}
                {{--url: "{{url('/rss/add/site')}}",--}}
                {{--type: 'POST',--}}
                {{--data: {--}}
                    {{--'site': $('#url').val()--}}
                {{--},--}}
                {{--success: function (data) {--}}
                    {{--if (data == "success") {--}}
                        {{--location.reload();--}}
                    {{--} else {--}}
                        {{--alert(data);--}}
                    {{--}--}}
                    {{--$('#addSite').html('<i class="fa fa-globe"></i> Add site');--}}
                {{--},--}}
                {{--error: function (data) {--}}
                    {{--alert("Something went wrong");--}}
                    {{--console.log(data.responseText);--}}
                    {{--$('#addSite').html('<i class="fa fa-globe"></i> Add site');--}}

                {{--}--}}
            {{--})--}}
        {{--});--}}

        $('#fb').on('change', function () {
            if (this.checked) {
                $('#fbPages').show(200);
                $('#fbGroups').show(200);
            } else {
                $('#fbPages').hide(200);
                $('#fbGroups').hide(200);
            }

        });

        $('#ln').on('change', function () {
            if (this.checked) {
                $('#liCompanySelection').show(200);

            } else {
                $('#liCompanySelection').hide(200);
            }

        });

        $('#addTarget').click(function () {
            if ($('#fb').is(':checked')) {
                fbPageId = $('#facebookPages').children(":selected").attr("id");
                fbPageName = $('#facebookPages').val();
                fbGroupId = $('#facebookGroups').children(":selected").attr("id");
                fbGroupName = $('#facebookGroups').val();

            } else {
                fbPageId = "no";
                fbPageName = "no";
                fbGroupId = "no";
                fbGroupName = "no";

            }

            if ($('#tw').is(':checked')) {
                tw = "yes";
            } else {
                tw = "no";
            }

            if ($("#in").is(':checked')) {
                instagram = "yes";
            } else {
                instagram = "no";
            }

            if ($('#ln').is(':checked')) {
                liCompanyId = $('#liCompanies').children(":selected").attr("id");
                liCompanyName = $('#liCompanies').val();
            } else {
                liCompanyName = "no";
                liCompanyId = "no";
            }
            $.ajax({
                type: 'POST',
                url: '{{url('/rss/add/target')}}',
                data: {
                    'fbPageId': fbPageId,
                    'fbPageName': fbPageName,
                    'fbGroupId': fbGroupId,
                    'fbGroupName': fbGroupName,
                    'tw': tw,
                    'instagram': instagram,
                    'liCompanyId': liCompanyId,
                    'liCompanyName': liCompanyName,
                    'in': instagram,
                    'site': $('#url').val()
                }, success: function (data) {
                    if (data == "success") {
                        alert("Success");
                        location.reload();
                    } else {
                        alert(data)
                    }
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            })
        });


        $('#btnServiceStart').click(function () {
            $.ajax({
                type: 'POST',
                url: '{{url('/service/start')}}',
                data: {
                    'type': 'rss'
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
                    'type': 'rss'
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