<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function startService(Request $request)
    {
        if (Service::where('userId', $request->userId)->exists()) {
            Service::where('userId', $request->userId)->update([
                $request->type => 'start'
            ]);
            return "success";
        } else {
            $service = new Service();
            $service->userId = $request->userId;
            if ($request->type == "fb") {
                $service->fb = "start";
            } elseif ($request->type == "tw") {
                $service->tw = "start";
            } elseif ($request->type == "pin") {
                $service->pin = "start";
            } elseif ($request->type == "in") {
                $service->in = "start";
            }
            $service->save();
            return "success";
        }
    }

    public function stopService(Request $request)
    {
        if (Service::where('userId', $request->userId)->exists()) {
            Service::where('userId', $request->userId)->update([
                $request->type => 'stop'
            ]);
            return "success";
        } else {
            $service = new Service();
            $service->userId = $request->userId;
            if ($request->type == "fb") {
                $service->fb = "stop";
            } elseif ($request->type == "tw") {
                $service->tw = "stop";
            } elseif ($request->type == "pin") {
                $service->pin = "stop";
            } elseif ($request->type == "in") {
                $service->in = "stop";
            }
            $service->save();
            return "success";
        }
    }
}
