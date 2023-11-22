<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('done');
        $plans = Plan::get();

        return view("Admin.plan.plan", compact("plans"));
    }
    public function cust()
    {
        $data['subscribers'] = User::whereHas('subscriptions')->get();
        $data['users'] = User::withRole('White Label Companies')->get();
        // dd(auth()->user()->invoices());
        // return auth()->user()->invoices();


        return view("Admin.plan.subscribers", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        Plan::create($request->all());
        return redirect()->back()->with('success', 'Plan Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan, Request $request)
    {
        $intent = auth()->user()->createSetupIntent();

        return view("Admin.plan.subscription", compact("plan", "intent"));
    }
    public function subscription(Request $request)
    {
        // return $request;
        $plan = Plan::find($request->plan);

        $subscription = $request->user()->newSubscription($plan->name, $plan->stripe_plan)
            ->create($request->token);

        // return view("Admin.plan.plan")->with('success','Plan Purchased Successfully');
        return redirect()->route('plan.index')->with('success','Plan Purchased Successfully');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
        Plan::destroy($id);
        return redirect()->back()->with('success', 'Plan deleted successfully');
    }
}
