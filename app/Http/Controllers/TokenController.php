<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Meter;
use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class TokenController extends Controller
{
    public function buy(Request $request)
    {
        $meter = Meter::findOrFail($request->id);

        $token = new Token();
        $token->meter_id = $request->id;

        //calculate my units
        //step 1 get whole total
        $total = $this->getMyUsage($request->id);

        //step 2 determine my billing rate
        $price = DB::table('pricings')
            ->where('min', '>=', $total)
            ->first();


        $token->units = ceil($request->amount / $price->price);
        $token->price = $request->amount;
        $token->token = Uuid::fromDateTime(Carbon::now());
        $token->save();
        return response()->json(['message' => 'Successfully bought units']);
    }

    public function list($id)
    {
        $user = User::findOrFail($id);
        $met = $user->meters()->orderByDesc('id')->get();

        //add the units count column
        $meters = collect();

        foreach ($met as $meter) {
            $usage = $this->getMyUsage($meter->id);
            $meter->units = $usage;
            $meters->push($meter);
        }

        return response()->json($meters);
    }

    public function tokens($id)
    {
        $meter = Meter::findOrFail($id);
        $usage = $this->getMyUsage($id);
        $tokens = $meter->tokens()->orderByDesc('id')->get();
        return response()->json(['units' => $usage, 'tokens' => $tokens]);
    }

    public function addmeter(Request $request)
    {
        $user = User::findOrFail($request->id);
        $exists = DB::table('meters')->where('number', '=', $request->number)->get();

        if (count($exists) == 0) {
            $meter = new Meter();
            $meter->number = $request->number;
            $meter->address = $request->address;
            $meter->user_id = $request->id;
            $meter->save();
            $meters = $user->meters()->orderByDesc('id')->get();
            return response()->json($meters);
        } else {
            return response()->json(['error' => 'Meter already added to the system']);
        }
    }

    public function getMyUsage($id)
    {
        $meter = Meter::findOrFail($id);
        $total = 0;

        foreach ($meter->tokens as $token) {
            $total += $token->units;
        }

        //get all devices wattage
        $wattage = 0;

        foreach (Device::all() as $device) {
            $wattage += $device->wattage;
        }

        $wd = $wattage * 8;

        //this is equivalent to 1 day's usage
        $kwh = $wd / 1000;

        $first = $meter->tokens->first();

        $credit = 0;

        if ($first != null) {
            $created = new Carbon($first->created_at);
            $now = Carbon::now();

            $difference = $created->diff($now)->days;

            $credit = ($total / ceil($kwh)) - $difference;
        }

        return $credit < 0 ? 0 : ceil($credit);
    }

    public function devices()
    {
        return response()->json(Device::all());
    }
}
