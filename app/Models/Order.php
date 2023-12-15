<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    // protected $table = 'orders';

    protected $fillable = [
        'code',
        'description',
        /**
         * Foreign Keys
         */
        'customer_id',
        'sale_channel_item_id',
        'order_status_slug'
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, "order_id", "id");
    }


    public function checkOrderStatusByPayment(): void
    {
        $orderItems = $this->orderItems;

        $orderPaymentsTotal = $this->payments->sum("price");

        $orderTotal = $orderItems->sum("price");

        $orderStatusSlug = "partial_payment_received";

        if ($orderPaymentsTotal >= $orderTotal) {
            $orderStatusSlug = "payment_received";
        }

        $this->order_status_slug = $orderStatusSlug;

        $this->save();
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, "orders_id", "id");
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, "customer_id", "id");
    }

    public function saleChannelItem()
    {
        return $this->belongsTo(SaleChannelItem::class, "sale_channel_item_id", "id");
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, "order_status_slug", "slug");
    }

    public function orderTotalPrice()
    {
        return $this->orderItems->sum(function ($orderItem) {
            return $orderItem->price * $orderItem->quantity;
        });
    }

    public function orderTotalPaid()
    {
        return $this->payments->sum("price");
    }

    public function orderTotalDue()
    {
        return $this->orderTotalPrice() - $this->orderTotalPaid();
    }
}
