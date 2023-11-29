<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BaseListRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Traits\HttpResponses;

class OrderController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(BaseListRequest $request)
    {
        return $this->success(OrderResource::collection(
            Order::orderBy('order', 'asc')->paginate($request->page_size, ["*"], "page", $request->page_number)
        ));
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
    public function store(Request $request)
    {
        //
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
     * Create new order with new order items
     *
     */
    public function createNewOrder(Request $request)
    {
        $checkOrder = Order::where('sale_channel_item_id', $request->sale_channel_item_id)
            ->where('customer_id', $request->customer_id)
            ->where('order_status_slug', 'received')
            ->first();

        if ($checkOrder) {
            return $this->error('Bu masada aktif siparişiniz bulunmaktadır.');
        }

        $order = Order::create([
            'code' => time(),
            'description' => $request->description,
            'customer_id' => $request->customer_id,
            'sale_channel_item_id' => $request->sale_channel_item_id,
            'order_status_slug' => 'received',
        ]);

        foreach ($request->order_items as $order_item) {
            $product = Product::findOrFail($order_item['product_id']);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $order_item['quantity'],
                'price' => $product->price,
                'note' => $order_item['note'],
                'status_id' => $order_item['status_id'],
            ]);
        }

        return $this->success(new OrderResource($order));
    }
}
