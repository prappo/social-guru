@extends('layouts.app')
@section('title','Add RSS Sites')

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
                        <div class="input-group input-group-xs">
                            <input id="url" type="text" placeholder="Input your site here" class="form-control">
                            <span class="input-group-btn">
                      <button id="addSite" type="button" class="btn btn-info btn-flat"><i class="fa fa-globe"></i> Add site</button>
                    </span>
                        </div>


                        <ul class="products-list product-list-in-box">
                            @foreach(\App\RssSites::where('userId',Auth::user()->id)->get() as $site)
                                <li class="item">

                                    <div class="product-info">
                                        <img src="{{$site->image}}"
                                             alt="Product Image">
                                        <a href="{{$site->link}}" target="_blank" class="product-title">{{$site->title}}

                                            <span class="product-description">{{$site->description}}</span></a>
                                        <a data-id="{{$site->id}}" class="label label-danger del pull-left">Delete</a>

                                    </div>
                                </li>
                        @endforeach

                        <!-- /.item -->
                        </ul>
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
        $('#addSite').click(function () {
            $('#addSite').html('<i class="fa fa-globe"></i> Please Wait ....');
            $.ajax({
                url: "{{url('/rss/add/site')}}",
                type: 'POST',
                data: {
                    'site': $('#url').val()
                },
                success: function (data) {
                    if (data == "success") {
                        location.reload();
                    } else {
                        alert(data);
                    }
                    $('#addSite').html('<i class="fa fa-globe"></i> Add site');
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                    $('#addSite').html('<i class="fa fa-globe"></i> Add site');

                }
            })
        });

        $('.del').click(function (data) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{url('/rss/delete/site')}}",
                type: 'POST',
                data: {
                    'id': id
                },
                success: function (data) {
                    if (data == "success") {
                        location.reload();
                    } else {
                        alert(data);
                    }
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);

                }
            })
        })
    </script>
@endsection