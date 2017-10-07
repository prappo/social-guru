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

    }

    public function addSite(Request $request)
    {
        try {
            $rss = new RssSites();
            $rss->userId = Auth::user()->id;
            $rss->site = $request->site;
            $rss->title = $request->title;
            $rss->link = $request->link;
            $rss->description = $request->description;
            $rss->image = "https://www.google.com/s2/favicons?domain=" . $request->site;
            $rss->save();
            return "success";
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function getSites()
    {
        $data = RssSites::where('userId', Auth::user()->id)->get();
        return view('RssSites', compact('data'));
    }

    public function getFeed(Request $request)
    {
        $rss = \Feed::loadRss($request->site);
        return $rss;
    }
}
