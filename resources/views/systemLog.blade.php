@extends('layouts.app')
@section('title','System Log | Social Guru')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                {{-- block 1 start--}}
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>

                        <th>User</th>
                        <th>Social</th>
                        <th>Message</th>
                        <th>Log Type</th>
                        <th>Timing</th>
                        <th>Time & Date</th>


                    </tr>
                    </thead>

                    <tbody>
                    @foreach($datas as $data)
                        <tr>

                            <td>@if($data->userName == "system") <span
                                        class="label bg-warning">System</span> @endif{{$data->userName}}</td>
                            <td>{{$data->social}}</td>
                            <td>{{$data->message}}</td>
                            <td>@if($data->type == "error") <span
                                        class="label bg-red">Error</span> @elseif($data->type=="success") <span
                                        class="label bg-green">Success</span> @else {{$data->type}} @endif</td>
                            <td>{{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</td>
                            <td>{{\Carbon\Carbon::parse($data->created_at)->toDateTimeString()}}</td>

                        </tr>

                    @endforeach

                    </tbody>

                    <tfoot>
                    <tr>

                        <th>User</th>
                        <th>Social</th>
                        <th>Message</th>
                        <th>Log Type</th>
                        <th>Timing</th>
                        <th>Time & Date</th>
                    </tr>
                    </tfoot>
                </table>
                {{-- block 1 end--}}

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
