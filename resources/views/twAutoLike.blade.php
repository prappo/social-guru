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
                        <li class=""><a href="#reporappt" data-toggle="tab" aria-expanded="false">Report</a></li>
                        <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li class="pull-left header"><i class="fa fa-twitter"></i> Twitter</li>
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
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button class="btn btn-twitter btn-flat" id="tag"><i
                                                        class="fa fa-tag"></i><!-- react-text: 25 -->
                                                <!-- /react-text --><!-- react-text: 26 -->Add Tag<!-- /react-text -->
                                                <!-- react-text: 27 --> <!-- /react-text --><!-- react-text: 28 -->
                                                <!-- /react-text --></button>
                                        </div>
                                        <input type="text" class="form-control"
                                               placeholder="Write one tag and press enter" value=""></div>
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
                                            <div>
                                                <div class="btn-group button-tag">
                                                    <button type="button" class="btn btn-default label-button"><img
                                                                class="img-circle" width="20"
                                                                src="https://pbs.twimg.com/profile_images/830129868373266432/a0_asx8X_normal.jpg"
                                                                style="margin-right: 5px;"><!-- react-text: 166 -->
                                                        travel<!-- /react-text --></button>
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"
                                                            style="font-size: 16px;"><span class="caret"></span><span
                                                                class="sr-only">Toggle Dropdown</span></button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li class="no-action"><a href="#"><i
                                                                        class="fa fa-users text-twitter"></i>
                                                                <!-- react-text: 174 -->2.8M<!-- /react-text -->
                                                                <!-- react-text: 175 --> <!-- /react-text -->
                                                                <!-- react-text: 176 -->followers<!-- /react-text -->
                                                            </a></li>
                                                        <li class="no-action"><a href="#"><i
                                                                        class="fa fa-user-plus text-twitter"></i>
                                                                <!-- react-text: 180 -->0<!-- /react-text -->
                                                                <!-- react-text: 181 --> <!-- /react-text -->
                                                                <!-- react-text: 182 -->conversions<!-- /react-text -->
                                                            </a></li>
                                                        <li><a href="https://www.twitter.com/travel" target="_blank"><i
                                                                        class="fa fa-external-link text-twitter"></i>
                                                                <!-- react-text: 186 --> Profile<!-- /react-text --></a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li><a href="#" class="removeTag"><i
                                                                        class="fa fa-close text-twitter"></i>
                                                                <!-- react-text: 191 --> Remove User<!-- /react-text -->
                                                            </a></li>
                                                    </ul>
                                                </div>
                                                <div class="btn-group button-tag">
                                                    <button type="button" class="btn btn-default label-button"><img
                                                                class="img-circle" width="20"
                                                                src="https://pbs.twimg.com/profile_images/3704055283/7830ca91dc1c7e34a27100568e628a93_normal.png"
                                                                style="margin-right: 5px;"><!-- react-text: 195 -->
                                                        TravelLeisure<!-- /react-text --></button>
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"
                                                            style="font-size: 16px;"><span class="caret"></span><span
                                                                class="sr-only">Toggle Dropdown</span></button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li class="no-action"><a href="#"><i
                                                                        class="fa fa-users text-twitter"></i>
                                                                <!-- react-text: 203 -->3.5M<!-- /react-text -->
                                                                <!-- react-text: 204 --> <!-- /react-text -->
                                                                <!-- react-text: 205 -->followers<!-- /react-text -->
                                                            </a></li>
                                                        <li class="no-action"><a href="#"><i
                                                                        class="fa fa-user-plus text-twitter"></i>
                                                                <!-- react-text: 209 -->0<!-- /react-text -->
                                                                <!-- react-text: 210 --> <!-- /react-text -->
                                                                <!-- react-text: 211 -->conversions<!-- /react-text -->
                                                            </a></li>
                                                        <li><a href="https://www.twitter.com/TravelLeisure"
                                                               target="_blank"><i
                                                                        class="fa fa-external-link text-twitter"></i>
                                                                <!-- react-text: 215 --> Profile<!-- /react-text --></a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li><a href="#" class="removeTag"><i
                                                                        class="fa fa-close text-twitter"></i>
                                                                <!-- react-text: 220 --> Remove User<!-- /react-text -->
                                                            </a></li>
                                                    </ul>
                                                </div>
                                                <div class="btn-group button-tag">
                                                    <button type="button" class="btn btn-default label-button"><img
                                                                class="img-circle" width="20"
                                                                src="https://pbs.twimg.com/profile_images/661903977244573696/XwtxYjX4_normal.jpg"
                                                                style="margin-right: 5px;"><!-- react-text: 224 -->
                                                        prappo_p<!-- /react-text --></button>
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"
                                                            style="font-size: 16px;"><span class="caret"></span><span
                                                                class="sr-only">Toggle Dropdown</span></button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li class="no-action"><a href="#"><i
                                                                        class="fa fa-users text-twitter"></i>
                                                                <!-- react-text: 232 -->33<!-- /react-text -->
                                                                <!-- react-text: 233 --> <!-- /react-text -->
                                                                <!-- react-text: 234 -->followers<!-- /react-text -->
                                                            </a></li>
                                                        <li class="no-action"><a href="#"><i
                                                                        class="fa fa-user-plus text-twitter"></i>
                                                                <!-- react-text: 238 -->0<!-- /react-text -->
                                                                <!-- react-text: 239 --> <!-- /react-text -->
                                                                <!-- react-text: 240 -->conversions<!-- /react-text -->
                                                            </a></li>
                                                        <li><a href="https://www.twitter.com/prappo_p"
                                                               target="_blank"><i
                                                                        class="fa fa-external-link text-twitter"></i>
                                                                <!-- react-text: 244 --> Profile<!-- /react-text --></a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li><a href="#" class="removeTag"><i
                                                                        class="fa fa-close text-twitter"></i>
                                                                <!-- react-text: 249 --> Remove User<!-- /react-text -->
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <div class="targetUserSearch">
                                            <form>
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-twitter btn-flat" type="submit"
                                                                id="searchTags"><i class="fa fa-tag"></i>
                                                            <!-- react-text: 257 --> Search Users <!-- /react-text -->
                                                        </button>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                           placeholder="Search by usernames" value=""></div>
                                            </form>
                                            <div class="suggestedTargetUsers">
                                                <ul class="users-list no-height clearfix target-users-list"></ul>
                                            </div>
                                            <div class="resetSearch"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-ban"></i><!-- react-text: 269 -->
                                        <!-- /react-text --><!-- react-text: 270 -->Blocked Tags<!-- /react-text -->
                                        <!-- react-text: 271 --> <!-- /react-text -->
                                        <small>Any tag added here will prevent any interaction with any tweet/media
                                            containing them
                                        </small>
                                    </h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body box-tour">
                                    <div>
                                        <blockquote><p>You do not have blocked tags yet.</p>
                                            <small>Add your first one using the form below</small>
                                        </blockquote>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <form>
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button class="btn btn-twitter btn-flat" type="submit" id="searchTags">
                                                    <i class="fa fa-tag"></i><!-- react-text: 285 -->
                                                    <!-- /react-text --><!-- react-text: 286 -->Add Negative Tag
                                                    <!-- /react-text --><!-- react-text: 287 --> <!-- /react-text -->
                                                </button>
                                            </div>
                                            <input type="text" class="form-control"
                                                   placeholder="Write one keyword and press enter" value=""></div>
                                    </form>
                                </div>
                            </div>

                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-user-times"></i><!-- react-text: 295 -->
                                        Blocked Users<!-- /react-text --><!-- react-text: 296 --> <!-- /react-text -->
                                        <small>Add any users you do not want to interact with</small>
                                    </h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                    class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div>
                                    <div class="box-body">
                                        <div>
                                            <div>
                                                <blockquote><p>You do not have users yet.</p>
                                                    <small>Add your first one using the form below</small>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <div class="targetUserSearch">
                                            <form>
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-twitter btn-flat" type="submit"
                                                                id="searchTags"><i class="fa fa-tag"></i>
                                                            <!-- react-text: 315 --> Search Users <!-- /react-text -->
                                                        </button>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                           placeholder="Search by usernames" value=""></div>
                                            </form>
                                            <div class="suggestedTargetUsers">
                                                <ul class="users-list no-height clearfix target-users-list"></ul>
                                            </div>
                                            <div class="resetSearch"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class=" tab-pane" id="report">
                            Report
                        </div>

                    </div>
                </div>

                {{-- block 1 end--}}

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
