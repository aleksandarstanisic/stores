<?php

namespace App\Http\Controllers\Shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\User;
use App\Store;
use App\Order;
use App\Cart;
use App\BAuth;
use App\Product;

class BuyerOrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('bauth');
        $this->middleware('buyer.haveAddress')->only(['store', 'update']);
        $this->middleware('buyer.order.owner')->except(['index', 'store', 'create']);
        $this->middleware('buyer.order.canEdit')->only(['destroy', 'edit', 'update', 'togglePause']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Store $store)
    {
        // $orders = BAuth::buyer($store)->orders()->latest()->get();
        $orders = bauth($store)->user()->orders()->latest()->get();
        return view('shopping.orders.index', compact('orders'));
    }

    /**
     * Create a new order.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, Store $store)
    {
        // return view('shopping.orders.create', ['cart' => BAuth::buyer($store)->cart]);
        return view('shopping.orders.create', ['cart' => bauth($store)->cart()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request, User $user, Store $store)
    {
        if (Cart::isEmpty($store)) {
            session()->flash('flash_danger', 'Korpa je prazna');
            return redirect()->back();
        }

        // Order::fullCreate(BAuth::buyer($store));
        Order::fullCreate($request->all(), bauth($store)->user());

        return redirect()->route('buyer.orders.index', [$user->slug, $store->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Store $store, Order $order)
    {
        return view('shopping.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Store $store, Order $order)
    {
        return view('shopping.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Store $store, Order $order)
    {
        $success = $order->fullUpdate($request->except(['_token', '_method']));

        if (!$success) {
            session()->flash('flash_danger', 'Nije izmenjena porudzbina');
        } else {
            session()->flash('flash_success', 'Uspesno izmenjena porudzbina');
        }

        return redirect()->route('buyer.orders.index', [$user->slug, $store->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,Store $store, Order $order)
    {
        $order->fullDelete();

        session()->flash('flash_success', 'Uspesno ste odustali od porudzbine');

        return redirect()->route('buyer.orders.index', [$user->slug, $store->slug]);
    }

    // If order isn't sent it will be paused
    // if order is paused it will be unpaused
    // and set in preparation
    public function togglePause(User $user,Store $store, Order $order)
    {
        $success = $order->togglePause();

        if (!$success) {
            session()->flash('flash_danger', 'Nije moguce izmeniti status');
        } else {
            session()->flash('flash_success', 'Uspesno izmenjen status');
        }

        return redirect()->back();
    }
}
