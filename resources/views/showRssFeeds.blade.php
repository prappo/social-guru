<div class="box-body">
    @foreach($rss->item as $data)
        <b>{{$data->title}}</b>
        <p><a href="{{$data->link}}">{{$data->link}}</a></p>
        <p>{!! $data->description !!}</p>

                <div data-step="9" data-intro="Options available according to your settings"
                     style="padding-left: 10px" class="form-group">
                        <div class="btn-group btn-group-xs" data-toggle="buttons">
                                @if(\App\Http\Controllers\Data::myPackage('fb'))
                                        @if(!empty(\App\Http\Controllers\Data::get('fbAppId')))
                                                <label class="btn btn-primary bg-blue">
                                                        <input id="fbCheck" type="checkbox" autocomplete="off"><i
                                                                class="fa fa-facebook"></i>
                                                        Facebook page
                                                </label>

                                                <label class="btn btn-primary bg-blue">
                                                        <input id="fbgCheck" type="checkbox" autocomplete="off"><i
                                                                class="fa fa-users"></i>
                                                        Facebook group
                                                </label>
                                        @endif
                                @endif

                                @if(\App\Http\Controllers\Data::myPackage('tw'))
                                        @if(!empty(\App\Http\Controllers\Data::get('twTokenSec')))
                                                <label class="btn btn-primary bg-light-blue">
                                                        <input id="twCheck" type="checkbox" autocomplete="off"><i
                                                                class="fa fa-twitter"></i>
                                                        Twitter
                                                </label>
                                        @endif
                                @endif

                                @if(\App\Http\Controllers\Data::myPackage('in'))
                                        @if(!empty(\App\Http\Controllers\Data::get('inPass')))
                                                <label class="btn btn-danger bg-red-gradient">
                                                        <input id="iCheck" type="checkbox" autocomplete="off"><i
                                                                class="fa fa-instagram"></i>
                                                        Instagram
                                                </label>
                                        @endif
                                @endif

                                @if(\App\Http\Controllers\Data::myPackage('wp'))

                                        @if(!empty(\App\Http\Controllers\Data::get('wpPassword')))
                                                <label class="btn btn-primary bg-blue-gradient">
                                                        <input id="wpCheck" type="checkbox" autocomplete="off"><i
                                                                class="fa fa-wordpress"></i>
                                                        Wordpress
                                                </label>
                                        @endif

                                @endif

                                @if(\App\Http\Controllers\Data::myPackage('tu'))
                                        @if(!empty(\App\Http\Controllers\Data::get('tuTokenSec')))
                                                <label class="btn btn-primary bg-gray">
                                                        <input id="tuCheck" type="checkbox" autocomplete="off"><i
                                                                class="fa fa-tumblr"></i>
                                                        Tumblr
                                                </label>
                                        @endif
                                @endif

                                {{--@if(!empty(\App\Http\Controllers\Data::get('skypePass')))--}}
                                {{--<label class="btn btn-primary bg-light-blue">--}}
                                {{--<input id="skypeCheck" type="checkbox" autocomplete="off"><i--}}
                                {{--class="fa fa-skype"></i>--}}
                                {{--Skype--}}
                                {{--</label>--}}
                                {{--@endif--}}

                                @if(\App\Http\Controllers\Data::myPackage('ln'))

                                        @if(!empty(\App\Http\Controllers\Data::get('liAccessToken')))
                                                <label class="btn btn-primary bg-light-blue-active">
                                                        <input id="linkedinCheck" type="checkbox" autocomplete="off"><i
                                                                class="fa fa-linkedin"></i>
                                                        Linkedin
                                                </label>
                                        @endif
                                @endif

                                @if(\App\Http\Controllers\Data::myPackage('pinterest'))
                                        @if(!empty(\App\Http\Controllers\Data::get('pinPass')))
                                                <label class="btn btn-danger bg-red">
                                                        <input id="pinCheck" type="checkbox" autocomplete="off"><i
                                                                class="fa fa-pinterest"></i>
                                                        Pinterest
                                                </label>
                                        @endif
                                @endif

                        </div>

                </div>

                <hr>
    @endforeach
</div>