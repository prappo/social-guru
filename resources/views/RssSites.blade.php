@extends('layouts.app')
@section('title','RSS Sites')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-rss"></i> RSS Feeds</h3>
                    </div>
                    <!-- /.box-header -->


                    <div class="box-body">
                        <div class="form-group">

                            <select id="site" class="form-control">
                                @foreach($datas as $data)
                                    <option id="{{$data->id}}">{{$data->site}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button id="getFeed" class="btn btn-success btn-block"><i class="fa fa-rss-square"></i> Get
                            Feeds
                        </button>
                    </div>

                    <div id="feed">

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">

                    </div>

                </div>


            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('js')
    <script>
        $('#getFeed').click(function () {
            $('#feed').html("<b>Please wait....</b>");
            $.ajax({
                type: 'POST',
                url: "{{url('/rss/feed/get')}}",
                data: {
                    "site": $('#site').val()
                },
                success: function (data) {
                    $('#feed').html(data);
                },
                error: function (data) {
                    $('#feed').html("");
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            })
        })
    </script>
@endsection