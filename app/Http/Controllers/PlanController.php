<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getplans()
    
    {
        $plans = Plan::all();
        foreach ($plans as $plan) {
            $plan->supported_devices = json_decode($plan->supported_devices);
        }

        return response()->json(['plans' => $plans]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $plan = new Plan;

        $data = $request->validate([
            'plan_type' => 'required',
            'monthly_price' => 'required',
            'resolution' => 'required',
            'video_quality' => 'required',
            'supported_devices' => 'required|string',
        ]);

        // $data['supported_devices'] = json_decode($request->supported_devices);

        $plan = Plan::create($data);

        return response()->json(['message' => 'Plan created successfully', 'plan' => $plan]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
