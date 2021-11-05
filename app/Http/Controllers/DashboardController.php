<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Campaign;
use App\Models\Creative;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    //


    /**
     * Method index
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function index(Request $request)
    {

        return view('dashboard.index');

    }


    /**
     * Method campaigns to display created advertising campaigns:
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function campaigns(Request $request)
    {

       $campaigns =  Campaign::orderBy('created_at', 'DESC')->paginate(8);
       return view('dashboard.campaigns.all', compact('campaigns'));

    }

    /**
     * Method newCampaign
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function newCampaign(Request $request)
    {
        return view('dashboard.campaigns.new');

    }

    /**
     * Method createCampaign
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function createCampaign(Request $request)
    {
        $request->validate([
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

            return redirect()->route('dashboard.campaigns')->with('status','Campaign created successfully');

        } else {
            return back()->withErrors(['Error! campaign could not be created.']);
        }
    }

    /**
     * Method uploadCreatives
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function uploadCreatives(Request $request)
    {
        $campaign = Campaign::firstOrFail('id', $request->id);


    }

    /**
     * Method addCreatives
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function addCreatives(Request $request)
    {
        return view('dashboard.creatives.new');
    }


    public function editCampaign(Request $request)
    {
        $campaign = Campaign::findOrFail($request->id);
        return view('dashboard.campaigns.edit', compact('campaign'));

    }

    public function updateCampaign (Request $request)
    {

        $campaign = Campaign::findOrFail($request->id);

        $request->validate([
            'name' => 'required|string|max:255',
            'total_budget' => 'required|numeric',
            'daily_budget' => 'required|numeric|lte:total_budget',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'creatives' => 'nullable',
            'creatives.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],[
            'daily_budget.lte' => 'The daily budget must be less than or equal to USD'.$request->total_budget
        ]);

        $campaign->name = $request->name;
        $campaign->total_budget = $request->total_budget;
        $campaign->daily_budget = $request->daily_budget;
        $campaign->start_date = $request->start_date;
        $campaign->end_date = $request->end_date;
        $campaign->destination_url = $request->destination_url;
        $campaign->update();

        foreach ($request->file('creatives') as $creative) {
            $path = $creative->store('creatives', 'public');
            Creative::create([
                'campaign_id' => $campaign->id,
                'creative_file' => $path
            ]);
        }

        return redirect()->route('dashboard.campaigns')->with('status','Campaign updated successfully');
    }
}
