<?php

namespace App\Http\Controllers;

use App\Http\Requests\BaseListRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(BaseListRequest $request)
    {
        return $this->success(
            Customer::orderBy("name", "asc")->paginate($request->page_size, ["*"], "page", $request->page_number)
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
    public function store(StoreCustomerRequest $request)
    {
        $request->validated();
        $customer = Customer::create([
            "name" => $request->first_name . " " . $request->last_name,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => strtolower($request->email),
            "phone" => $request->phone
        ]);
        return $this->success($customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->success(Customer::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id)
    {
        $request->validated();
        return $this->success(Customer::findOrFail($id)->update([
            "name" => $request->first_name . " " . $request->last_name,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => strtolower($request->email),
            "phone" => $request->phone
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->success(Customer::findOrFail($id)->delete());
    }
}
