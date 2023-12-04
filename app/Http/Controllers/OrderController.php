<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BaseListRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Traits\HttpResponses;
use App\Http\Requests\Order\OrderMoveOrderItemsRequest;

class OrderController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(BaseListRequest $request)
    {
        $order = Order::query();

        if ($request->search) {
            $order->where('code', 'like', '%' . $request->search . '%');
        }

        if ($request->order_status_slug) {
            $order->where('order_status_slug', $request->order_status_slug);
        }

        if ($request->customer_id) {
            $order->where('customer_id', $request->customer_id);
        }

        if ($request->sale_channel_item_id) {
            $order->where('sale_channel_item_id', $request->sale_channel_item_id);
        }

        if ($request->start_date) {
            $order->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $order->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->sort_by) {
            $order->orderBy($request->sort_by, $request->sort_direction);
        } else {
            $order->orderBy('created_at', 'desc');
        }

        return $this->success(new OrderCollection(
            $order->paginate($request->page_size, ["*"], "page", $request->page_number)
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
     * Display the specified resource. Also this showing included order items
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return $this->success(new OrderResource($order));
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
    public function update(UpdateOrderRequest $request, string $id)
    {
        //
        $request->validated();

        $order = Order::findOrFail($id);

        $order->update([
            'description' => $request->description,
            'customer_id' => $request->customer_id,
            'sale_channel_item_id' => $request->sale_channel_item_id,
            'order_status_slug' => $request->order_status_slug ? $request->order_status_slug : $order->order_status_slug,
        ]);

        foreach ($request->order_items as $order_item) {
            $product = Product::findOrFail($order_item['product_id']);
            OrderItem::updateOrCreate([
                'order_id' => $order->id,
                'product_id' => $product->id,
            ], [
                'quantity' => $order_item['quantity'],
                'price' => $product->price,
                'note' => $order_item['note'],
                'status_id' => $order_item['status_id'],
            ]);
        }

        return $this->success(new OrderResource($order));
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

    /**
     * Change order sales_channel_item_id.
     * If there is an active order in new sales_channel_item_id then add order items to this order.
     * If there is no active order in new sales_channel_item_id then create new order with order items.
     *
     * If comes parameters is same with current order then do nothing.
     */
    public function moveOrderItems(OrderMoveOrderItemsRequest $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order_items = OrderItem::where('order_id', $order->id)
            ->get();

        $checkOrder = Order::where('sale_channel_item_id', $request->sale_channel_item_id)
            ->where('customer_id', $order->customer_id)
            ->whereIn('order_status_slug', ['received', 'processing'])
            ->first();

        // If comes parameters is same with current order then do nothing.
        if ($order->sale_channel_item_id == $request->sale_channel_item_id) {
            return $this->success(new OrderResource($order));
        }

        if ($checkOrder) {
            foreach ($order_items as $order_item) {
                $checkOrderItem = OrderItem::where('order_id', $checkOrder->id)
                    ->where('product_id', $order_item->product_id)
                    ->first();

                if ($checkOrderItem) {
                    $checkOrderItem->update([
                        'quantity' => $checkOrderItem->quantity + $order_item->quantity,
                    ]);
                } else {
                    OrderItem::create([
                        'order_id' => $checkOrder->id,
                        'product_id' => $order_item->product_id,
                        'quantity' => $order_item->quantity,
                        'price' => $order_item->price,
                        'note' => $order_item->note,
                        'status_id' => $order_item->status_id,
                    ]);
                }
                $order_item->delete();
            }
            $order->delete();
            return $this->success(new OrderResource($checkOrder));
        } else {
            $order->update([
                'sale_channel_item_id' => $request->sale_channel_item_id,
            ]);
            return $this->success(new OrderResource($order));
        }
    }

    /**
     * Get order reports by date range
     */
    public function getReports(Request $request)
    {
        $orders = Order::query();

        if ($request->start_date) {
            $orders->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $orders->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $orders->get();

        return $this->success([
            'total' => count($orders),
            'orders' => $orders,
        ]);
    }

    /**
     * Get order item most sold products by date range and group by product
     */
    public function getMostSoldProducts(Request $request)
    {
        $orders = Order::query();

        if ($request->start_date) {
            $orders->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $orders->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $orders->get();

        $order_items = OrderItem::whereIn('order_id', $orders->pluck('id'))->leftJoin('products', 'order_items.product_id', '=', 'products.id')
            ->get();

        $order_items = $order_items->groupBy('product_id');
        $order_items = $order_items->map(function ($item) {
            return [
                'product_id' => $item[0]->product_id,
                'product_name' => $item[0]->name,
                'quantity' => $item->sum('quantity'),
            ];
        });

        $order_items = $order_items->sortByDesc('quantity');

        return $this->success([
            'total' => count($order_items),
            'order_items' => $order_items,
        ]);
    }
}
