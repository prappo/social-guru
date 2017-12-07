@extends('layouts.app')
@section('title','Add Pinterest account | Social Guru')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                {{-- block 1 start--}}
                <div class="col-md-6">

                    <div class="box box-primary">
                        <div class="box-header with-border" align="center">
                            <h3 class="box-title"><i class="fa fa-pinterest"></i>Add Pinterest Account</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group">
                                <label for="pinUser">Pinterest Username</label>
                                <input class="form-control" type="text"
                                       value="" placeholder="Your Pinterest User name"
                                       id="pinUser">
                            </div>

                            <div class="form-group">
                                <label for="pinPass">Pinterest Password</label>
                                <input class="form-control"
                                       value=""
                                       placeholder="Your Pinterest password"
                                       type="password" id="pinPass">
                            </div>


                            <div class="box-footer">

                                <button id="add" class="btn btn-primary btn-block"><i class="fa fa-plus-circle"></i>
                                    Add account
                                </button>
                            </div>
                        </div>
                        </form>
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
                url: '{{url('/pinterest/add')}}',
                data: {
                    'pinUser': $('#pinUser').val(),
                    'pinPass': $('#pinPass').val()
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
            })
        })
    </script>
@endsection