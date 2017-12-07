<?php

namespace App\Http\Controllers;

use App\InstagramContentList;
use App\InTags;
use App\LogList;
use App\OptSchedul;
use App\pinTags;
use App\PinterestContentList;
use App\RssData;
use App\RssSites;
use App\rssTarget;
use App\Service;
use App\Setting;
use App\TwitterContentList;
use App\TwTags;
use App\User;
use Carbon\Carbon;
use DateTime;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use seregazhuk\PinterestBot\Factories\PinterestBot;

class ScheduleController extends Controller
{
    public function __construct()
    {
        \App::setLocale(CoreController::getLang());

    }

    /*this code for next version */

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = OptSchedul::where('userId', Auth::user()->id)->get();
        return view('schedule', compact('data'));
    }

    /**
     * @param Request $re
     * @return string
     */
    public function addSchedule(Request $re)
    {

        $title = $re->title;
        $caption = $re->caption;
        $link = $re->link;
        $image = $re->image;
        $description = $re->description;
        $status = $re->status;
        $postId = $re->postId;
        $time = $re->time;
        $fb = $re->fb;
        $fbg = $re->fbg;
        $tw = $re->tw;
        $tu = $re->tu;
        $instagram = $re->instagram;
        $linkedin = $re->linkedin;
        $pageId = $re->pageId;
        $pageToken = $re->pageToken;
        $blogName = $re->blogName;
        $groupId = $re->groupId;
        $wp = $re->wp;
        $imagetype = $re->imagetype;
        $sharetype = $re->sharetype;

        if ($status == "") {
            return "Please write something";
        }
        $schedule = new OptSchedul();
        try {
            $schedule->title = $title;
            $schedule->caption = $caption;
            $schedule->link = $link;
            $schedule->image = $image;
            $schedule->description = $description;
            $schedule->content = $status;
            $schedule->postId = $postId;
            $schedule->time = $time;
            $schedule->fb = $fb;
            $schedule->tw = $tw;
            $schedule->tu = $tu;
            $schedule->fbg = $fbg;
            $schedule->wp = $wp;
            $schedule->instagram = $instagram;
            $schedule->linkedin = $linkedin;
            $schedule->groupId = $groupId;
            $schedule->pageId = $pageId;
            $schedule->pageToken = $pageToken;
            $schedule->blogName = $blogName;
            $schedule->imagetype = $imagetype;
            $schedule->sharetype = $sharetype;
            $schedule->userId = Auth::user()->id;
            $schedule->date = Carbon::parse($time)->format('Y-m-d');
            $schedule->save();
            echo "success";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param Request $re
     */
    public function sdel(Request $re)
    {

        $id = $re->id;

        try {
            OptSchedul::where('id', $id)->delete();
            echo "success";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param Request $re
     * @return string
     */
    public function sedit(Request $re)
    {
        $id = $re->id;
        $title = $re->title;
        $content = $re->data;
        $type = $re->type;
        try {
            OptSchedul::where('id', $id)->update(['title' => $title, 'content' => $content, 'type' => $type]);
            return "success";

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function scheduleDay()
    {
        $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d');

        $data = $this->getDatesFromRange($startOfWeek, $endOfWeek);
        return view('scheduleFilter', compact('data'));
    }

    public function filter(Request $request)
    {
        if ($request->from == "" || $request->to == "") {
            return "Invalid input <br><a href='" . url('/schedule/day') . "'>Go Back</a> ";
        }

//        $days =  $this->getDatesFromRange($request->from,$request->to);
        $data = $this->getDatesFromRange($request->from, $request->to);
//        foreach (array_chunk($data,7) as $d){
////            print_r($d);
//            foreach($d as $a){
//                print_r($a);
//            }
//        }

//        exit;
//        print_r($data);
//        exit;
//        foreach ($days as $day){
//            echo Carbon::parse($day)->format('jS F ') . "<br>";
//        }
//
//        exit;
//        $datas = OptSchedul::where('content', 'LIKE', '%');
//        $data = $datas->whereBetween('time', array(new DateTime($request->from), new DateTime($request->to)))->orderBy('time','asc')->where('userId',Auth::user()->id)->groupby('date')->get();


//        foreach ($data as $d){
//            echo $d->time . "<br>";
//        }
//        exit;
        return view('scheduleFilter', compact('data', 'days'));
    }

    public function filterThisWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = Carbon::now()->endOfWeek()->format('Y-m-d');

        $data = $this->getDatesFromRange($startOfWeek, $endOfWeek);
        return view('scheduleFilter', compact('data'));
    }

    public function filterThisMonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');

        $data = $this->getDatesFromRange($startOfMonth, $endOfMonth);
        return view('scheduleFilter', compact('data'));
    }

    public function allDays()
    {
        $data = OptSchedul::all();
        return view('scheduleDay', compact('data'));

    }

    public function getDatesFromRange($date_time_from, $date_time_to)
    {

        // cut hours, because not getting last day when hours of time to is less than hours of time_from
        // see while loop
        $start = Carbon::createFromFormat('Y-m-d', substr($date_time_from, 0, 10));
        $end = Carbon::createFromFormat('Y-m-d', substr($date_time_to, 0, 10));


        $dates = [];

        while ($start->lte($end)) {

            $dates[] = $start->copy()->format('Y-m-d');
//            $dates[] = $start->copy()->format('l jS \\of F Y h:i:s A');

            $start->addDay();
        }

        return $dates;
    }

    public function timeUpdate(Request $request)
    {
        try {
            OptSchedul::where('id', $request->id)->update([
                'time' => Carbon::parse($request->time)->format('Y-m-d H:i'),
                'date' => Carbon::parse($request->time)->format('Y-m-d')

            ]);
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function fire()
    {
//        \File::put(base_path('/test.txt'),Carbon::now()->toDateTimeString());
        $carbon = new Carbon();
        $tasks = OptSchedul::all();

        foreach ($tasks as $task) {
            if ($carbon->parse($task->time)) {
                $postTime = $task->time;
                $currentTime = $carbon->now()->format('Y-m-d H:i');

                $timezone = User::where('id', $task->userId)->value('timezone');

                $date = Carbon::createFromFormat('Y-m-d H:i', $postTime, $timezone);
                $date->setTimezone('UTC');
                $realPostTime = $date->format('Y-m-d H:i');

//                Test block start


//                Test block end

                if ($currentTime == $realPostTime) {


                    if ($task->fb == "yes") {

                        Write::fbWriteS($task->postId, $task->pageId, $task->pageToken, $task->title, $task->caption, $task->link, $task->image, $task->description, $task->content, $task->imagetype, $task->sharetype, $realPostTime);
                    }

                    if ($task->fbg == "yes") {
                        Write::fbgWriteS($task->postId, $task->pageId, $task->title, $task->caption, $task->link, $task->image, $task->description, $task->content, $task->imagetype, $task->sharetype);

                    }

                    if ($task->tw == "yes") {
                        Write::twWriteS($task->postId, $task->image, $task->content, $realPostTime);
                    }

                    if ($task->tu == "yes") {
                        Write::tuWriteS($task->postId, $task->blogName, $task->title, $task->content, $task->image, $task->imagetype, $realPostTime);
                    }

                    if ($task->wp == "yes") {
                        Write::wpWriteS($task->postId, $task->title, $task->content);
                    }

                    if ($task->instagram == "yes") {
                        Write::inWriteS($task->postId, $task->image, $task->content);
                    }


                }
            }
        }
    }


    public function grabInstagramContent()
    {
        $datas = InTags::take(1)->where('status', 'pending')->get();


        $id = "";
        $userId = "";
        $tag = "";

//        get single value form database

        foreach ($datas as $data) {
            $userId = $data->userId;
            $tag = $data->tag;
            $id = $data->id;
        }

        if ($tag == "") {
            exit;
        }

        if (Service::where('userId', $userId)->value('in') != "start") {
            exit;

        }


// trying to login to instagram

        $instagram = new \InstagramAPI\Instagram();
        $username = Setting::where('userId', $userId)->value("inUser");
        $password = Setting::where('userId', $userId)->value("inPass");


        try {
            $instagram->setUser($username, $password);
            $instagram->login(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        $inDatas = $instagram->getHashtagFeed($tag);

        foreach ($inDatas->items as $inData) {
            if (!InstagramContentList::where('userId', $userId)->where('content_id', $inData->code)->exists()) {
                $contentList = new InstagramContentList();
                $contentList->userId = $userId;
                $contentList->content_id = $inData->pk;
                $contentList->content_link = "https://www.instagram.com/p/" . $inData->code;
                $contentList->tag_id = $tag;
                $contentList->status = "pending";
                $contentList->save();
            }

        }
        InTags::where('id', $id)->update([
            'status' => 'done'
        ]);


    }

    public function instagramService()
    {
        // Make sure the url fired successfully
        $log = new LogList();
        $log->userName = "System";
        $log->userId = "System";
        $log->social = "instagram";
        $log->message = "Url fired at " . Carbon::now();
        $log->type = "log";
        $log->save();


        $datas = InstagramContentList::take(1)->where('status', 'pending')->get();


//        get single value form database

        foreach ($datas as $data) {
            $userId = $data->userId;
            $id = $data->id;
            $contentId = $data->content_id;


            if (Service::where('userId', $userId)->value('in') == "start") {
                $instagram = new \InstagramAPI\Instagram();
                $username = Setting::where('userId', $userId)->value("inUser");
                $password = Setting::where('userId', $userId)->value("inPass");

                try {

                    $instagram->setUser($username, $password);
                    $instagram->login(true);
                    $info = $instagram->like($contentId);
                    InstagramContentList::where('id', $id)->update([
                        'status' => 'done'
                    ]);

                    $log = new LogList();
                    $log->userName = User::where('id', $userId)->value('name');
                    $log->userId = $userId;
                    $log->social = "instagram";
                    $log->message = "Successfully liked " . $contentId;
                    $log->type = "success";
                    $log->save();
                    print_r($info);

                } catch (\Exception $exception) {
                    $log = new LogList();
                    $log->userName = User::where('id', $userId)->value('name');
                    $log->userId = $userId;
                    $log->social = "instagram";
                    $log->message = "Instagram is refusing the connection from your VPS. Technical details : [ " . $exception->getMessage() . " ] ";
                    $log->type = "error";
                    $log->save();
                    print_r($exception->getMessage());


                }
            }


        }


    }


    public function twitterService()
    {
        $datas = TwitterContentList::take(3)->where('status', 'pending')->get();


        foreach ($datas as $data) {
            $userId = $data->userId;
            $id = $data->id;
            $contentId = $data->content_id;

            if (Service::where('userId', $userId)->value('tw') == "start") {

                $consumerKey = Setting::where('userId', $userId)->value('twConKey');
                $consumerSecret = Setting::where('userId', $userId)->value('twConSec');
                $accessToken = Setting::where('userId', $userId)->value('twToken');
                $tokenSecret = Setting::where('userId', $userId)->value('twTokenSec');
                $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);
                try {
                    $twitter->request('favorites/create', 'POST', array('id' => $contentId));
                    TwitterContentList::where('id', $id)->update([
                        'status' => 'done'
                    ]);

                    $log = new LogList();
                    $log->userName = User::where('id', $userId)->value('name');
                    $log->userId = $userId;
                    $log->social = "twitter";
                    $log->message = "Successfully liked " . $contentId;
                    $log->type = "success";
                    $log->save();


                } catch (\Exception $exception) {
                    $log = new LogList();
                    $log->userName = User::where('id', $userId)->value('name');
                    $log->userId = $userId;
                    $log->social = "Instagram";
                    $log->message = $exception->getMessage();
                    $log->type = "error";
                    $log->save();
                }

            }


        }

    }

    public function grabTwitterContent()
    {
        $datas = TwTags::take(1)->where('status', 'pending')->get();
        $id = "";
        $usreId = "";
        $tag = "";
        foreach ($datas as $data) {
            $usreId = $data->userId;
            $tag = $data->tag;
            $id = $data->id;
        }

        if ($tag == "") {
            exit;
        }

        if (Service::where('userId', $usreId)->value('tw') != "start") {
            exit;

        }


        $consumerKey = Setting::where('userId', $usreId)->value('twConKey');
        $consumerSecret = Setting::where('userId', $usreId)->value('twConSec');
        $accessToken = Setting::where('userId', $usreId)->value('twToken');
        $tokenSecret = Setting::where('userId', $usreId)->value('twTokenSec');
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $tokenSecret);

        $tweets = $twitter->request('search/tweets', 'GET', array('q' => '#' . $tag, 'count' => 10));

        foreach ($tweets->statuses as $tweet) {
            if (!TwitterContentList::where('userId', $usreId)->where('content_id', $tweet->id)->exists()) {
                $contentList = new TwitterContentList();
                $contentList->userId = $usreId;
                $contentList->content_id = $tweet->id;
                $contentList->content_link = "https://twitter.com/" . $tweet->user->screen_name . "/status/" . $tweet->id;
                $contentList->tag_id = $tag;
                $contentList->status = "pending";
                $contentList->save();
            }
        }

        TwTags::where('id', $id)->update([
            'status' => 'done'
        ]);


    }


    public function grabPinterestContent()
    {

        $datas = pinTags::take(1)->where('status', 'pending')->get();
        $id = "";
        $userId = "";
        $tag = "";

        foreach ($datas as $data) {
            $userId = $data->userId;
            $tag = $data->tag;
            $id = $data->id;
        }

        if ($tag == "") {
            exit;
        }

        if (Service::where('userId', $userId)->value('pin') != "start") {
            exit;

        }

        $pinterest = PinterestBot::create();
        $pinterest->auth->login(Setting::where('userId', $userId)->value('pinUser'), Setting::where('userId', $userId)->value('pinPass'));

        $pins = $pinterest->pins->search($tag)->toArray();

        foreach ($pins as $pin) {
            if (!PinterestContentList::where('userId', $userId)->where('content_id', $pin['id'])->exists()) {
                $contentList = new PinterestContentList();
                $contentList->userId = $userId;
                $contentList->content_id = $pin['id'];
                $contentList->content_link = "https://www.pinterest.com/pin/" . $pin['id'];
                $contentList->tag_id = $tag;
                $contentList->status = "pending";
                $contentList->save();
            }
        }

        pinTags::where('id', $id)->update([
            'status' => 'done'
        ]);

    }

    public function pinterestService()
    {

        $datas = PinterestContentList::take(3)->where('status', 'pending')->get();
        echo "[-] Took 3 data <br>";
        foreach ($datas as $data) {
            $userId = $data->userId;
            $id = $data->id;
            $contentId = $data->content_id;
            echo "[-] Reacting with {$contentId} <br>";

            if (Service::where('userId', $userId)->value('pin') == "start") {
                echo "[-] Trying to login <br>";

                try {
                    echo "[-] Trying to lik the content ID [ {$contentId} ]";
                    PinterestContentList::where('id', $id)->update([
                        'status' => 'done'
                    ]);
                    $pinterest = PinterestBot::create();
                    $pinterest->auth->login(Setting::where('userId', $userId)->value('pinUser'), Setting::where('userId', $userId)->value('pinPass'));
                    $pinterest->pins->like($contentId);

                    echo "done <br>";
                } catch (\Exception $exception) {

                    echo "<p style='color:red'> Error for {$contentId} [ " . $exception->getMessage() . " ] </p>";
                }


            }
            echo "[-] Task complete for {$contentId}";
        }
    }

    public function testRequest()
    {
        $log = new LogList();
        $log->save();
        return "success";
    }

    public function checkRequest()
    {
        foreach (LogList::take(20)->orderBy('id', 'DESC')->get() as $log) {
            echo Carbon::parse($log->created_at)->diffForHumans() . "<br>";
        }
    }

    public function grabRssContent()
    {
        $data = rssTarget::take(1)->where('status', 'pending')->get();
        foreach ($data as $d) {


            $userId = $d->userId;
            $id = $d->id;

            if (Service::where('userId', $userId)->value('rss') != "start") {
                exit;
            }

            $rss = \Feed::loadRss($d->site);

            foreach ($rss->item as $r) {
                if (!RssData::where('link', $r->link)->exists()) {
                    $site = new RssData();
                    $site->userId = $userId;
                    $site->title = $r->title;
                    $site->link = $r->link;
                    $site->description = $r->description;
                    $site->date = $r->pubDate;
                    $site->fb = "pending";
                    $site->tw = "pending";
                    $site->li = "pending";
                    $site->time = $r->timestamp;
                    $site->save();


                }


            }

            RssSites::where('id', $id)->update([
                'status' => 'done'
            ]);
        }


    }

    public function rssPostFacebook()
    {
        $datas = RssData::take(5)->where('fb', 'pending')->get();

        foreach ($datas as $data) {
            $fbAppId = Setting::where('userId', $data->userId)->value('fbAppId');
            $appSec = Setting::where('userId', $data->userId)->value('fbAppSec');

            $fb = new Facebook([
                'app_id' => $fbAppId,
                'app_secret' => $appSec,
                'default_graph_version' => 'v2.6',
            ]);

            $pageId = "";
            $accessToken = "";

            try {
                $content = [
                    "message" => $data->description
                ];
                $post = $fb->post($pageId . "/feed", $content, $accessToken);

            } catch (FacebookSDKException $fse) {

                return $fse->getMessage();
            }
        }


    }

    public function resetRssSites()
    {
        RssSites::query()->update([
            'status' => 'pending'
        ]);
    }
}




















