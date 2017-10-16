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
                        <div class="input-group input-group-xs">
                            <input id="url" type="text" placeholder="Input your site here" class="form-control">
                            <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat"><i class="fa fa-globe"></i></button>
                    </span>
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
                                            <select id="facebookPages">
                                                @foreach(\App\FacebookPages::where('userId',Auth::user()->id)->get() as $fbPages)
                                                    <option id="{{$fbPages->pageId}}">{{$fbPages->pageName}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="fbGroups" style="display: none">
                                            <hr>
                                            <select id="facebookGroups">
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
                                                            <option value="{{ $liCompany['id'] }}">{{ $liCompany['name'] }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </fieldset>
                                        </div>
                                    @endif
                                @endif

                                @if(\App\Http\Controllers\Data::myPackage('in'))
                                    @if(!empty(\App\Http\Controllers\Data::get('inPass')))
                                        <div class="checkbox">
                                            <label>
                                                <input id="in" type="checkbox">
                                                <i class="fa fa-instagram"></i> Instagram
                                            </label>
                                        </div>
                                    @endif
                                @endif


                            </div>
                            <button id="addTarget" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Add
                                Target
                            </button>

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

            }
            swal('Success', 'Done !', 'success');
            location.reload();
        })

    </script>
@endsection