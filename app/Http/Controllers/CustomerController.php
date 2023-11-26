<?php

namespace App\Http\Controllers;

use App\Http\Resources\BaseListResource;
use App\Http\Requests\BaseListRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(BaseListRequest $request)
    {
        return $this->success(
            Customer::orderBy("name","asc")->paginate($request->page_size,["*"],"page",$request->page_number)
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
}
