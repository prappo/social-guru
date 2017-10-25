<?php

namespace App\Http\Controllers;

use App\Setting;
use App\TwFollowers;
use App\TwTags;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TwitterController extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }


        if (Data::get('twTokenSec') == "" || Data::get('twConKey') == "") {
            return redirect('/settings');
        }

//        $consumerKey = Data::get('twConKey');
//        $consumerSecret = Data::get('twConSec');
//        $accessToken = Data::get('twToken');
//        $tokenSecret = Data::get('twTokenSec');
//
//        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
//
//        $me = $twitter->load(\Twitter::ME);
//        $twRep = $twitter->load(\Twitter::REPLIES);
//        $tw = $twitter->load(\Twitter::ME_AND_FRIENDS);
//        return view('Twitter', compact('tw', 'twRep', 'me'));


        return view('twAutoLike');
    }

    public function getInboxIndex()
    {

    }

    /**
     * @param Request $re
     * @return string
     */
    public function retweet(Request $re)
    {

        $id = $re->id;

        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('statuses/retweet', 'POST', array('id' => $id));
            return "success";
//            print_r($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return string
     */
    public static function retweetnow($id)
    {
        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }


        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('statuses/retweet', 'POST', array('id' => $id));
            return "success";

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param Request $re
     * @return string
     */
    public function twSendMsg(Request $re)
    {
        $username = $re->username;
        $text = $re->text;
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('direct_messages/new', 'POST', array('screen_name' => $username, 'text' => $text));
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $user
     * @param $message
     * @return string
     */
    public static function SendMsg($user, $message)
    {

        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }


        $username = $user;
        $text = $message;
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('direct_messages/new', 'POST', array('screen_name' => $username, 'text' => $text));
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param Request $request
     * @return string
     */
    public function twReply(Request $request)
    {
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');
        $text = $request->text;
        $statusId = $request->id;
        $username = $request->username;
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('statuses/update', 'POST', array('status' => "@" . $username . " " . $text, 'in_reply_to_status_id' => $statusId), NULL);
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * @param $id
     * @param $user
     * @param $text
     * @return string
     */
    public static function twReplyNow($id, $user, $text)
    {

        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }


        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        $statusId = $id;
        $username = $user;
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        try {
            $data = $twitter->request('statuses/update', 'POST', array('status' => "@" . $username . " " . $text, 'in_reply_to_status_id' => $statusId), NULL);
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function massSend()
    {

        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }

        return view('twmasssend');
    }

    /**
     * @param Request $re
     * @return string
     */
    public function massMessageSend(Request $re)
    {
        $message = $re->text;
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');

        try {
            $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
            $followers = $twitter->request('followers/list', 'GET', []);
            $count = 0;
            echo '
                <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>                          
                                <th>User</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>';
            foreach ($followers->users as $users) {
                $msg = TwitterController::SendMsg($users->screen_name, $message);
                echo '<tr>';
                echo '<td>' . $users->screen_name . '</td>';
                echo '<td>' . $msg . '</td>';
                echo '</tr>';
                if ($msg == 'success') {
                    $count++;
                }

            }
            echo '</tbody><tfoot>
                            <tr> 
                                <th>User</th>
                                <th>Status</th>
                            </tr>
                            </tfoot>
                        </table>';
            echo '<div class="alert alert-success" role="alert">Successfully sent to ' . $count . ' users </div>';

        } catch (\TwitterException $e) {
//            die("something went wrong . We couldn't fetch data form twitter . May be maximum api request done");
            return "error";
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sendMessage()
    {
        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }

        return view('twsendmessage');
    }

    /**
     * @return string
     */
    public function autoRetweet()
    {

        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }

        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        $count = 0;
        try {
            $mentions = $twitter->request('statuses/mentions_timeline', 'GET');
            echo '<table class="table"><thead><tr><th>User</th><th>Tweet</th><th>Status</th></tr></thead><tbody>';
            foreach ($mentions as $m) {

                echo '<tr>';
                echo '<td>' . $m->user->screen_name . "</td>";
                echo '<td>' . $m->text . "</td>";

                $msg = self::retweetnow($m->id);
                if ($msg == 'success') {
                    $count++;
                    echo '<td>' . $msg . '</td>';
                } else {
                    echo '<td>' . $msg . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
            echo '<div class="alert alert-success" role="alert">Total ' . $count . ' retweeted</div>';


        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoRetweetIndex()
    {

        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }

        return view('retweet');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function autoReply(Request $request)
    {

        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }

        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        $count = 0;
        $text = $request->text;
        try {
            $mentions = $twitter->request('statuses/mentions_timeline', 'GET');
            echo '<table class="table"><thead><tr><th>User</th><th>Tweet</th><th>Status</th></tr></thead><tbody>';
            foreach ($mentions as $m) {

                echo '<tr>';
                echo '<td>' . $m->user->screen_name . "</td>";
                echo '<td>' . $m->text . "</td>";


                $msg = self::twReplyNow($m->id, $m->user->screen_name, $text);
                if ($msg == 'success') {
                    $count++;
                    echo '<td>' . $msg . '</td>';
                } else {
                    echo '<td>' . $msg . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
            echo '<div class="alert alert-success" role="alert">Total ' . $count . ' replied</div>';


        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * @param Request $request
     * @return string
     */
    public static function autoReplyAll(Request $request)
    {
        $consumerKey = FollowersController::get_value('twConKey');
        $consumerSecret = FollowersController::get_value('twConSec');
        $accessToken = FollowersController::get_value('twToken');
        $tokenSecret = FollowersController::get_value('twTokenSec');
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
        $count = 0;
        $text = $request->text;
        try {
            $mentions = $twitter->request('statuses/home_timeline', 'GET');
            echo '<table class="table"><thead><tr><th>User</th><th>Tweet</th><th>Status</th></tr></thead><tbody>';
            foreach ($mentions as $m) {

                echo '<tr>';
                echo '<td>' . $m->user->screen_name . "</td>";
                echo '<td>' . $m->text . "</td>";


                $msg = self::twReplyNow($m->id, $m->user->screen_name, $text);
                if ($msg == 'success') {
                    $count++;
                    echo '<td>' . $msg . '</td>';
                } else {
                    echo '<td>' . $msg . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
            echo '<div class="alert alert-success" role="alert">Total ' . $count . ' replied</div>';


        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function autoReplyIndex()
    {
        if (!Data::myPackage('tw')) {
            return view('errors.404');
        }

        return view('reply');
    }

    public function autoLikeIndex()
    {
        $consumerKey = Data::get('twConKey');
        $consumerSecret = Data::get('twConSec');
        $accessToken = Data::get('twToken');
        $tokenSecret = Data::get('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
//
//        $me = $twitter->load(\Twitter::ME);
//        $twRep = $twitter->load(\Twitter::REPLIES);
//        $tw = $twitter->load(\Twitter::ME_AND_FRIENDS);
//        return view('Twitter', compact('tw', 'twRep', 'me'));

        try {
            $results = $twitter->request('users/search', 'GET', array('q' => "prappo", 'count' => 10));
            print_r($results);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function addTag(Request $request)
    {
        if (TwTags::where('userId', Auth::user()->id)->where('tag', $request->tag)->exists()) {
            return "Tag already added";
        }

        try {
            $addTag = new TwTags();
            $addTag->userId = Auth::user()->id;
            $addTag->tag = $request->tag;
            $addTag->status = 'pending';
            $addTag->save();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function getTags()
    {
        try {
            $tags = TwTags::where('userId', Auth::user()->id)->get();
            foreach ($tags as $tag) {
                echo '
                <div class="btn-group button-tag">
                                                    <button type="button" class="btn btn-default label-button">
                                                        ' . $tag->tag . '
                                                    </button>
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"><span
                                                                class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li class="no-action"><a href="#"><i
                                                                        class="fa fa-users text-twitter"></i>
                                                                Status ' . $tag->status . '
                                                            </a></li>

                                                        <li class="divider"></li>

                                                        <li><a  data-id="' . $tag->id . '" class="removeActiveTag"><i
                                                                        class="fa fa-close text-twitter"></i>
                                                                Remove Tag
                                                            </a></li>
                                                    </ul>
                                                </div>
                                                
                ';
            }
            echo '
            <script>
            $(".removeActiveTag").click(function () {
            
            var id = $(this).attr("data-id");
            $.ajax({
                type: "POST",
                url: "' . url('/twitter/tag/remove') . '",
                data: {
                    "id": id
                },
                success: function (data) {
                    if (data == "success") {
                        getTags();
                    }
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            });
        });
            </script>
            ';

        } catch (\Exception $exception) {
            return "Something went wrong";
        }
    }

    public function deleteTag(Request $request)
    {
        try {
            TwTags::where('id', $request->id)->delete();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function findFollower(Request $request)
    {
        $consumerKey = Data::get('twConKey');
        $consumerSecret = Data::get('twConSec');
        $accessToken = Data::get('twToken');
        $tokenSecret = Data::get('twTokenSec');

        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);

        try {
            $results = $twitter->request('users/search', 'GET', array('q' => $request->data, 'count' => 12));
            foreach ($results as $result) {
                echo '
                <li>
                <img src="' . $result->profile_image_url . '" alt="User Image">
                <a class="users-list-name" href="#">' . $result->followers_count . ' followers</a>
                <button data-id="' . $result->screen_name . '" data-followers="' . $result->followers_count . '" data-pic="' . $result->profile_image_url . '" class="btn btn-success btn-xs followUser">
                <i class="fa fa-user-plus"></i> ' . $result->screen_name . '
                </button>
                </li>
                ';
            }
            echo '
            <script>
        $(".followUser").click(function () {
            
            var username = $(this).attr("data-id");
            var image = $(this).attr("data-pic");
            var twFollowers = $(this).attr("data-followers");
            $.ajax({
                type: "POST",
                url: "' . url("/twitter/add/follower") . '",
                data: {
                    "username": username,
                    "image": image,
                    "followers": twFollowers
                },
                success: function (data) {
                    if(data =="success"){
                        showFollowers();
                    }
                },
                error:function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            })
        });
            </script>
            ';

        } catch (\Exception $exception) {
            return "Something went wrong";
        }
    }

    public function getFollowers()
    {

        try {
            foreach (TwFollowers::where('userId', Auth::user()->id)->get() as $followers) {
                echo '
                 <div class="btn-group button-tag">
                                                    <button type="button" class="btn btn-default label-button"><img
                                                                class="img-circle" width="20"
                                                                src="' . $followers->profile_pic . '"
                                                                style="margin-right: 5px;">
                                                        ' . $followers->username . '</button>
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"
                                                            style="font-size: 16px;"><span class="caret"></span><span
                                                                class="sr-only">Toggle Dropdown</span></button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li class="no-action"><a href="#"><i
                                                                        class="fa fa-users text-twitter"></i>
                                                                ' . $followers->followers . '
                                                                <!-- react-text: 175 --> <!-- /react-text -->
                                                                <!-- react-text: 176 -->followers<!-- /react-text -->
                                                            </a></li>
                                                        <li class="no-action"><a href="#"><i
                                                                        class="fa fa-user-plus text-twitter"></i>
                                                                <!-- react-text: 180 -->' . $followers->conversions . '<!-- /react-text -->
                                                                <!-- react-text: 181 --> <!-- /react-text -->
                                                                <!-- react-text: 182 -->conversions<!-- /react-text -->
                                                            </a></li>
                                                        <li><a href="https://www.twitter.com/' . $followers->username . '" target="_blank"><i
                                                                        class="fa fa-external-link text-twitter"></i>
                                                                <!-- react-text: 186 --> Profile<!-- /react-text --></a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li><a href="#" data-id="' . $followers->id . '" class="removeUser"><i
                                                                        class="fa fa-close text-twitter"></i>
                                                                <!-- react-text: 191 --> Remove User<!-- /react-text -->
                                                            </a></li>
                                                    </ul>
                                                </div>
             ';
            }

            echo '
            <script>
            $(".removeUser").click(function() {
              var id = $(this).attr("data-id");
              $.ajax({
                  type:"POST",
                  url:"' . url('/twitter/follower/delete') . '",
                  data:{
                      "id":id
                  },
                  success:function(data){
                  if(data=="success"){
                  showFollowers();
                  }
                  },
                  error:function(data){
                    alert("Something went wrong");
                    console.log(data.responseText);
                    
                  }
              })
            })
            </script>
            ';
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function addFollowers(Request $request)
    {
        if (!TwFollowers::where('username', $request->username)->where('userId', Auth::user()->id)->exists()) {
            try {

                $follower = new TwFollowers();
                $follower->userId = Auth::user()->id;
                $follower->username = $request->username;
                $follower->profile_pic = $request->image;
                $follower->followers = $request->followers;
                $follower->conversions = 0;
                $follower->profile_link = "";
                $follower->is_follow = "no";
                $follower->save();
                return "success";

            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
        } else {
            return "Already exists";
        }


    }

    public function deleteFollower(Request $request)
    {
        try {
            TwFollowers::where('userId', Auth::user()->id)->where('id', $request->id)->delete();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


}
