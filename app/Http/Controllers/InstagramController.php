<?php

namespace App\Http\Controllers;

use App\InFollowers;
use App\InTags;
use Facebook\HttpClients\FacebookGuzzleHttpClient;
use Guzzle\Http\Client;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;


class InstagramController extends Controller
{


    public function __construct()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        \App::setLocale(CoreController::getLang());


    }

    /**
     * My feed
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }


        return view('instagram');
    }

    /**
     * Home page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');


        }

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        $datas = $instagram->timelineFeed();

        return view('instagramTimeline', compact('datas'));
    }


    /**
     * Popular feed according to user likes and views
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function popular()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        $i = $instagram;
        $datas = $i->getPopularFeed();

        return view('instagramPopular', compact('datas'));
    }

    /**
     * Get followers count
     * @return string
     */
    public function getFollowers()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        try {
            return $instagram->getSelfUsernameInfo()->user->follower_count;
        } catch (\Exception $exception) {
            return "Error";
        }

    }

    /**
     * Get following count
     * @return string
     */
    public function getFollowing()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        try {
            return $instagram->getSelfUsernameInfo()->user->following_count;
        } catch (\Exception $exception) {
            return "Error";
        }

    }

    /**
     * Get the users activity whome we follow
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFollowingUserActivity()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        $data = $instagram->getFollowingRecentActivity();
        $datas = $data->fullResponse->stories;
//        print_r($datas->fullResponse->stories);
////        exit;
        return view('instagramFollowingActivity', compact('datas'));
    }


    public function test()
    {

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        $i = $instagram;

        $datas = $i->searchUsers('prappo');
//        print_r($datas);
        foreach ($datas->users as $data) {
            echo $data->username;
        }
    }

    /**
     * Write new post to instagram
     * @param Request $request
     * @return string
     */
    public function write(Request $request)
    {

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        try {
            $instagram->uploadPhoto(public_path() . "/uploads/" . $request->image, $request->caption);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function writef($image, $caption)
    {

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        try {
            $instagram->uploadPhoto(public_path() . "/uploads/" . $image, $caption);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function delete(Request $request)
    {
        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


        try {
            $instagram->deleteMedia($request->id);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function deletef($id)
    {
        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


        try {
            $instagram->deleteMedia($id);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function like(Request $request)
    {
        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


        try {
            $instagram->like($request->id);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function likef($id)
    {
        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        try {
            $instagram->like($id);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function comment(Request $request)
    {
        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        try {
            $instagram->comment($request->id, $request->text);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function commentf($id, $text)
    {

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


        try {
            $instagram->comment($id, $text);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function follow(Request $request)
    {
        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


        try {
            $instagram->follow($request->userId);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function followf($userId)
    {

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


        try {
            $instagram->follow($userId);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function unfollow(Request $request)
    {
        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


        try {
            $instagram->unfollow($request->userId);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function messagef($ids = array(), $messgae)
    {
        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        if ($messgae == "") {
            return "Message can't be empty";
        }
        try {
            $instagram->direct_message($ids, $messgae);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


    }

    public function message(Request $request)
    {

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


        if ($request->messgae == "") {
            return "Message can't be empty";
        }
        try {
            $instagram->direct_message($request->ids, $request->messgae);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function getMediaInfoIndex()
    {

        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        return view('instagramMediaInfo');
    }

    public function getMediaInfo($mediaId)
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        $datas = $instagram->mediaInfo($mediaId);
//        print_r($datas);
//        exit;
        $data = $datas->items[0];
        return view('instagramMediaInfo', compact('data'));
    }

    public function followers()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        $datas = $instagram->getSelfUserFollowers();

        return view('instagramFollowers', compact('datas'));
    }

    public function following()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        $datas = $instagram->getSelfUsersFollowing();

        return view('instagramFollowing', compact('datas'));
    }

    public function followBack()
    {

        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


        $insta = $instagram;
        $datas = $insta->getSelfUserFollowers();
        $count = 0;
        foreach ($datas->users as $data) {
            try {
                $insta->follow($data->pk);
                $count++;
            } catch (\Exception $exception) {

            }


        }
        return "Now you are following $count users";
    }

    public function followByTag(Request $request)
    {

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        $insta = $instagram;
        $datas = $insta->getHashtagFeed($request->tag);
        $numberOfResults = $datas->num_results;
        $count = 0;
        foreach ($datas->ranked_items as $data) {
            try {
                $insta->follow($data->user->pk);
                $count++;
            } catch (\Exception $exception) {
            }


        }
        return "Number of top ranked results $numberOfResults and you are following $count user";

    }

    public function unfollowAll()
    {
        if (!Data::myPackage('in')) {
            return view('errors.404');
        }

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


        $insta = $instagram;
        $datas = $insta->getSelfUsersFollowing();
        $count = 0;
        foreach ($datas->fullResponse->users as $data) {
            try {
                $insta->unfollow($data->pk);
                $count++;
            } catch (\Exception $exception) {

            }

        }
        return "Unfollowed $count users";
    }

    public function autoComment(Request $request)
    {

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        $insta = $instagram;

        $count = 0;
        if ($request->type == "home") {
            $datas = $insta->timelineFeed();
            foreach ($datas->feed_items as $data) {
                if (isset($data->media_or_ad)) {
                    $insta->comment($data->media_or_ad->id, $request->comment);
                    $count++;
                }

            }
            return "Commented on $count home posts";
        } elseif ($request->type == "popular") {
            $datas = $insta->getPopularFeed();
            foreach ($datas['items'] as $data) {
                $insta->comment($data['id'], $request->comment);
                $count++;
            }
            return "Commented on $count popular posts";
        } elseif ($request->type == "self") {
            $datas = $insta->getSelfUserFeed();
            foreach ($datas->items as $data) {
                $insta->comment($data->id, $request->comment);
                $count++;
            }
            return "Commented on $count self posts";
        } elseif ($request->type == "hashtag") {
            $datas = $insta->getHashtagFeed($request->tag);
            foreach ($datas->ranked_items as $data) {
                $insta->comment($data->id, $request->comment);
                $count++;
            }
            return "Commented on $count hashtag posts";
        }
    }

    public function scraper(Request $request)
    {

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        $insta = $instagram;

        if ($request->type == "tag") {
            $datas = $insta->getHashtagFeed($request->data);
            return view('instaGetHashTagFeed', compact('datas'));
        } elseif ($request->type == "user") {
            $datas = $insta->searchUsers($request->data);
            return view('instaSearchUsers', compact('datas'));
        } elseif ($request->type == "location") {
            $datas = $insta->searchFBLocation($request->data);
            return view('instaSearchLocation', compact('datas'));
        }
    }


    public function getTagFeed()
    {

    }

    public function findUsers(Request $request)
    {

        $instagram = new \InstagramAPI\Instagram();
        $username = Data::get('inUser');
        $password = Data::get('inPass');

        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


        $users = $instagram->searchUsers($request->data);

        foreach ($users->users as $user) {
            echo '
                <li>
                <img src="' . $user->profile_pic_url . '" alt="User Image">
                <a class="users-list-name" href="#">' . $user->follower_count . ' followers</a>
                <button data-id="' . $user->full_name . '" data-followers="' . $user->follower_count . '" data-pic="' . $user->profile_pic_url . '" class="btn btn-success btn-xs followUser">
                <i class="fa fa-user-plus"></i> ' . $user->username . '
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
                url: "' . url("/instagram/add/follower") . '",
                data: {
                    "username": username,
                    "image": image,
                    "followers": twFollowers,
                  
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

    }

    public function getInFollowers()
    {
        try {
            foreach (InFollowers::where('userId', Auth::user()->id)->get() as $followers) {
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
                  url:"' . url('/instagram/follower/delete') . '",
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


    public function removeTag(Request $request)
    {
        try {
            InTags::where('userId', Auth::user()->id)->where('id', $request->id)->delete();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function addTag(Request $request)
    {
        try {
            $tags = new InTags();
            $tags->userId = Auth::user()->id;
            $tags->tag = $request->tag;
            $tags->conversation = 0;
            $tags->save();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function getTags()
    {
        try {
            $tags = InTags::where('userId', Auth::user()->id)->get();
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
                                                                ' . $tag->conversion . ' conversions
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
                url: "' . url('/instagram/tag/remove') . '",
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

    public function addFollower(Request $request)
    {
        try {
            $follower = new InFollowers();
            $follower->userId = Auth::user()->id;
            $follower->username = $request->username;
            $follower->followers = $request->followers;
            $follower->profile_pic = $request->image;
            $follower->is_follow = "no";
            $follower->conversions = 0;
            $follower->save();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


    }


    public function deleteFollower(Request $request)
    {
        try {
            InFollowers::where('userId', Auth::user()->id)->where('id', $request->id)->delete();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }


}
