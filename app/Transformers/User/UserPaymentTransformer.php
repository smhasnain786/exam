<?php

namespace App\Transformers\User;

use App\Models\Payment;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class UserPaymentTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Payment $payment
     * @return array
     */
    public function transform(Payment $payment)
    {
        return [
            'payment_id' => $payment->payment_id,
            'plan' => $payment->plan->full_name,
            'amount' => $payment->total_amount.' '.$payment->currency,
            'date' => Carbon::parse($payment->payment_date)->toDayDateTimeString(),
            'invoice_no' => $payment->invoice_id,
            'method' => config('qwiktest.payment_processors')[$payment->payment_processor]['name'],
            'status' => $payment->status,
        ];
    }
}
