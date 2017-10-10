<?php

namespace App\Http\Controllers;

use App\RssSites;
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
}
