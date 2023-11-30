<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaleChannel\StoreSaleChannelItemRequest;
use App\Models\SaleChannelItem;
use App\Traits\HttpResponses;
use App\Http\Requests\BaseListRequest;
use App\Models\Order;
use Illuminate\Contracts\Database\Eloquent\Builder;

class SaleChannelItemController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index(BaseListRequest $request)
    {
        return $this->success(
            SaleChannelItem::orderBy("name", "asc")->paginate($request->page_size, ["*"], "page", $request->page_number)
        );
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
    public function store(StoreSaleChannelItemRequest $request)
    {
        $request->validated();

        $saleChannelItem = SaleChannelItem::create([
            "sale_channel_slug" => $request->sale_channel_slug,
            "sale_channel_item_group_id" => $request->sale_channel_item_group_id,
            "name" => $request->name,
            "description" => $request->description
        ]);

        return $this->success($saleChannelItem);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->success(SaleChannelItem::findOrFail($id));
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
    public function update(StoreSaleChannelItemRequest $request, string $id)
    {
        $request->validated();

        return $this->success(SaleChannelItem::findOrFail($id)->update([
            "sale_channel_slug" => $request->sale_channel_slug,
            "sale_channel_item_group_id" => $request->sale_channel_item_group_id,
            "name" => $request->name,
            "description" => $request->description
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->success(SaleChannelItem::findOrFail($id)->delete());
    }

    /**
     * Get all sale channel items with orders
     */

    public function getSaleChannelItemsWithOrders()
    {
        // This is one item with orders
        // $items = SaleChannelItem::where("sale_channel_slug","dine-in")->find(1)->orders;

        // This is all items with orders
        $items = SaleChannelItem::where("sale_channel_slug", "dine-in")->with(['orders' => function (Builder $query) {
            // hide intelisense error
            /** @var Order $query */
            $query->where('order_status_slug', 'received');
        }])->get();

        return $this->success($items);
    }
}
