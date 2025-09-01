<?php

namespace App\Http\Controllers\Api;

use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Models\UserApplication;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Stripe\Checkout\Session as CheckoutSession;

class PaymentController extends Controller
{
    public function intend(Request $request)
    {
        //

        $validated = $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'payment_method' => 'required|string|in:sslcommerz,stripe',
        ]);

        $application = new UserApplication();
        $application->user_id = auth()->user()->id;
        $application->job_id = $request->job_id;
        $application->payment_method = $request->payment_method;
        $application->paid = 0;
        $application->status = 'processing';
        $application->payment_status = 'unpaid';
        $application->save();

        if ($validated['payment_method'] === 'stripe') {
            return $this->stripeCheckout($application);
        }

        if ($validated['payment_method'] === 'sslcommerz') {
            return $this->sslcommerzCheckout($application);
        }

        return response()->json(['error' => 'Unsupported payment method'], 422);
        Log::info('request for payment', [$request->all()]);
        Log::info('user intended', [auth()->user()->id]);
    }

    private function stripeCheckout(UserApplication $application)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $checkout_session = CheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'bdt',
                    'product_data' => [
                        'name' => 'Job Application Fee',
                    ],
                    'unit_amount' => 10000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.payment.success', ['user_application_id' => $application->id]) . '&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.payment.cancel', ['user_application_id' => $application->id]),
            'metadata' => [
                'application_id' => $application->id,
                'job_id' => $application->job_id,
                'user_id' => $application->user_id,
            ],
        ]);

        // Log::info('url generated', [$checkout_session->url]);
        return response()->json(['redirect_url' => $checkout_session->url]);
    }

    public function stripeSuccess(Request $request)
    {
        $user_application = UserApplication::findOrFail($request->user_application_id);
        $user_application->update([
            'paid' => 100,
            'payment_status' => 'paid',
            'status' => 'submitted',
        ]);

        Log::info('Payment success in stripe', [$request->all()]);

        $redirect_url = env('FRONTEND_URL') . '/payment-success/upload-cv?application_id=' . $user_application->id;

        return redirect($redirect_url);
    }

    public function stripeCancel(Request $request)
    {
        $user_application = UserApplication::findOrFail($request->user_application_id);
        $user_application->update([
            'paid' => 0,
            'payment_status' => 'failed',
            'status' => 'failed',
        ]);

        // Log::warning('Payment cancelled', ['application_id' => $application->id]);

        return redirect(env('FRONTEND_URL'));
    }

    private function sslcommerzCheckout(UserApplication $application)
    {
        // Implement SSLCommerz API call here
        return response()->json(['message' => 'SSLCommerz not implemented yet']);
    }
}
