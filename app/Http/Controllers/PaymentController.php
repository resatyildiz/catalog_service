<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use App\Models\Order;

class PaymentController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $request->validate();

        $payment = Payment::create($request->validated());

        return response()->json($payment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Add payment, check and edit order status.
     *
     * If order is paid, check if all items are paid.
     * If all items are paid, change order status to paid.
     * If not all items are paid, change order status to partially paid.
     */

    public function addPayment(Request $request)
    {
        $request->validate([
            "orders_id" => "required|exists:orders,id",
            "sale_channel_items_id" => "required|exists:sale_channel_items,id",
            "payment_method_type" => "required|exists:payment_method_types,slug",
            "price" => "required|numeric",
        ]);

        // Check if order is paid, dont't add payment
        $order = Order::find($request->orders_id);

        if ($order->order_status_slug === "payment_received") {
            return response()->json([
                "message" => "Order is already paid",
            ], 400);
        }

        $payment = Payment::create($request->all());

        $order = $payment->order;

        $order->checkOrderStatusByPayment();

        // return payments and order total, paid and due
        return response()->json([
            "payments" => $order->payments,
            "orderTotalPrice" => $order->orderTotalPrice(),
            "orderTotalPaid" => $order->orderTotalPaid(),
            "orderTotalDue" => $order->orderTotalDue(),
        ]);
    }
}
