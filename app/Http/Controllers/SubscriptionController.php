<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(auth()->user()->subscribed('main')){
                return redirect('/')->with('message', ['warning' => __('app.courses.subscribe')]);
            }
            return $next($request);
        })->only('plans', 'processSubscription');
    }

    public function plans()
    {
        return view('subscriptions.plans');
    }

    public function processSubscription(Request $request)
    {
        $token = $request->stripeToken;

        try{
            if(request()->filled('coupon')){
                request()->user()->newSubscription('main', request('type'))
                    ->withCoupon(request('coupon'))->create($token);
            }else{
                request()->user()->newSubscription('main', request('type'))
                    ->create($token);
            }
            return redirect()->route('subscription.admin')
                ->with('message',['success', __('app.subscriptions.subscriptions_ok')]);

        }catch (Exception $exception){
            $error = $exception->getMessage();
            return back()->with('message', ['danger', $error]);
        }


    }

    public function admin()
    {
        $subscriptions = auth()->user()->subscriptions;
        return view('subscriptions.admin', compact('subscriptions'));
    }

    public function resume(Request $request)
    {
        $subscription = $request->user()->subscription($request->plan);
        if($subscription->cancelled() && $subscription->onGracePeriod()){
            $request->user()->subscription($request->plan)->resume();
            return back()->with('message', ['success', 'Has reanudado tu suscripción correctamente']);
        }

        return back();
    }

    public function cancel(Request $request)
    {
        auth()->user()->subscription($request->plan)->cancel();
        return back()->with('message', ['success', 'la suscripción no se ha cancelado correctamente']);

    }
}
