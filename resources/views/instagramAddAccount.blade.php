@extends('layouts.app')
@section('title','Add Instagram Account | Social Guru')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                {{-- block 1 start--}}
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Account</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="user" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="pass" placeholder="Password">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                            <button type="button" id="add" class="btn btn-info btn-block"><i
                                        class="fa fa-plus-circle"></i> Add
                            </button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
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
                url: '{{url('/instagram/add')}}',
                data: {
                    'user': $('#user').val(),
                    'pass': $('#pass').val()
                },
                success: function (data) {
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

            });
        })
    </script>
@endsection
