<?php

namespace App\Http\Controllers;

use App\RssSites;
use App\rssTarget;
use App\whereToPost;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class RssController extends Controller
{
    public function index()
    {
        return view('addRssSite');

    }

    public function addSite(Request $request)
    {

        $rssData = \Feed::loadRss($request->site);
        $title = $rssData->title;
        $description = $rssData->description;
        $link = $rssData->link;
        $image = "https://www.google.com/s2/favicons?domain=" . $link;

        //        If site already exists
        if (RssSites::where('userId', Auth::user()->id)->where('site', $link)->exists()) {
            return "This site already exits";
        }

//        if (strpos($request->site, "/rss" !== false)) {
//            $image = "https://www.google.com/s2/favicons?domain=" . str_replace("/rss", "", $request->site);
//        } elseif (strpos($request->site, "/rss/" !== false)) {
//            $image = "https://www.google.com/s2/favicons?domain=" . str_replace("/rss/", "", $request->site);
//        } elseif (strpos($request->site, "/feed" !== false)) {
//            $image = "https://www.google.com/s2/favicons?domain=" . str_replace("/feed", "", $request->site);
//        } elseif (strpos($request->site, "/feed/" !== false)) {
//            $image = "https://www.google.com/s2/favicons?domain=" . str_replace("/feed/", "", $request->site);
//        }
        try {
            $rss = new RssSites();
            $rss->userId = Auth::user()->id;
            $rss->site = $request->site;
            $rss->title = $title;
            $rss->link = $link;
            $rss->description = $description;
            $rss->image = $image;
            $rss->status = "pending";
            $rss->save();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function getSites()
    {
        $datas = RssSites::where('userId', Auth::user()->id)->get();
        return view('RssSites', compact('datas'));
    }

    public function getFeed(Request $request)
    {
        $rss = \Feed::loadRss($request->site);
        return view('showRssFeeds', compact('rss'));
    }

    public function deleteSite(Request $request)
    {
        try {
            RssSites::where('userId', Auth::user()->id)->where('id', $request->id)->delete();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function storeFeeds()
    {


    }

    public function whereToPost(Request $request)
    {

        try {
            $whereToPost = new whereToPost();
            $whereToPost->userId = Auth::user()->id;
            $whereToPost->link = $request->link;
            $whereToPost->fb = $request->fb;
            $whereToPost->tw = $request->fb;
            $whereToPost->in = $request->in;
            $whereToPost->li = $request->li;
            $whereToPost->save();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function rssTargetIndex()
    {
        $datas = RssSites::where('userId', Auth::user()->id)->get();

        if (Data::get('liAccessToken') != "") {
            try {
                $liCompanies = LinkedinController::companies()['values'];
            } catch (Exception $exception) {
                $liCompanies = "";
            }

        } else {
            $liCompanies = "";
        }
        return view('rssTarget', compact('liCompanies', 'datas'));
    }

    public function rssTargetInsert(Request $request)
    {
        if (rssTarget::where('userId', Auth::user()->id)->where('site', $request->site)->exists()) {
            return "This site already added";
        }
        if ($request->site == "") {
            return "Please enter Site URL";
        }
        try {
            $rssTarget = new rssTarget();
            $rssTarget->userId = Auth::user()->id;
            $rssTarget->site = $request->site;
            $rssTarget->fbPageId = $request->fbPageId;
            $rssTarget->fbPageName = $request->fbPageName;
            $rssTarget->fbGroupId = $request->fbGroupId;
            $rssTarget->fbGroupName = $request->fbGroupName;
            $rssTarget->tw = $request->tw;
            $rssTarget->in = $request->in;
            $rssTarget->liCompanyId = $request->liCompanyId;
            $rssTarget->liCompanyName = $request->liCompanyName;
            $rssTarget->save();
            return "success";

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}

























