@extends('layouts.app')
@section('title','Add Twitter Account | Social Guru')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

            {{-- block 1 start--}}


            <!-- /.box-header -->
                <!-- form start -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border" align="center">
                            <h3 class="box-title"><i class="fa fa-twitter"></i> Add Twitter Account</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group">
                                <label for="twConKey">Consumer Key</label>
                                <input class="form-control" value="" id="twConKey"
                                       placeholder="Your twitter consumer key" type="text">
                            </div>
                            <div class="form-group">
                                <label for="twConSec">Consumer Secret</label>
                                <input class="form-control" value="" id="twConSec"
                                       placeholder="Your twitter consumer secret" type="text">
                            </div>

                            <div class="form-group">
                                <label for="twToken">Token</label>
                                <input class="form-control" value="" id="twToken"
                                       placeholder="Your twitter token"
                                       type="text">
                            </div>

                            <div class="form-group">
                                <label for="twTokenSec">Token Secret</label>
                                <input class="form-control" value="" id="twTokenSec"
                                       placeholder="Your twitter token secret" type="text">
                            </div>

                            <div class="form-group">
                                <label for="twUser">Username</label>
                                <input class="form-control" value="" id="twUser"
                                       placeholder="Your twitter username"
                                       type="text">
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button id="add" class="btn btn-primary btn-block"><i class="fa fa-plus-circle"></i> Add
                                new account
                            </button>
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
        $('#add').click(function () {
            $.ajax({
                type: 'POST',
                url: '{{url('/twitter/add')}}',
                data: {
                    'twConKey': $('#twConKey').val(),
                    'twConSec': $('#twConSec').val(),
                    'twToken': $('#twToken').val(),
                    'twTokenSec': $('#twTokenSec').val(),
                    'twUser': $('#twUser').val()
                },
                success: function (data) {
                    if (data == "success") {
                        alert("Success");
                        location.reload();
                    } else {
                        alert(data)
                    }
                }
                ,
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);

                }

            })
            ;
        })
    </script>
@endsection
