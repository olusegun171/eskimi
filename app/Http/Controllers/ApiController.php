<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{

    /**
     * API Method campaigns to return all advertising campaigns:
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function campaigns(Request $request)
    {

       $campaigns =  Campaign::orderBy('created_at', 'DESC')->get();
       return response()->json(['status'=> 0, 'data'=> $campaigns], 200);

    }


    /**
     * API Method to create campaign
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function createCampaign(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'total_budget' => 'required|numeric',
            'daily_budget' => 'required|numeric|lte:total_budget',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'creatives' => 'required',
            'creatives.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],[
            'daily_budget.lte' => 'The daily budget must be less than or equal to USD'.$request->total_budget
        ]);


        if ($validate->passes()) {

            $campaign = Campaign::create([
                'name' => $request->name,
                'user_id' => Auth::user()->id,
                'total_budget' => $request->total_budget,
                'daily_budget' => $request->daily_budget,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'destination_url' => $request->destination_url,
            ]);

            if ($campaign) {

                foreach ($request->file('creatives') as $creative) {
                    $path = $creative->store('creatives', 'public');
                    Creative::create([
                    'campaign_id' => $campaign->id,
                    'creative_file' => $path
                    ]);
                }

                return response()->json(['status'=> 1, 'data'=> 'Campaign created successfully'], 200);


            } else {
                return response()->json(['status'=> 0, 'data'=> 'Error! campaign could not be created.'], 200);

            }

          } else {
              return response()->json(['status'=> 0, 'error'=> $validate->errors()->all()], 200);
          }
    }
}
