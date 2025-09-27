<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = Order::with(['user', 'orderItems.product'])->get();
        return response()->json($orders);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'order_date' => 'required|date',
            'status' => 'required|string|in:pending,processing,completed,cancelled',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0'
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_date' => $validated['order_date'],
            'status' => $validated['status']
        ]);

        foreach ($validated['items'] as $item) {
            $order->orderItems()->create($item);
        }

        $order->load(['user', 'orderItems.product']);
        return response()->json($order, 201);
    }

    public function show(Order $order): JsonResponse
    {
        $order->load(['user', 'orderItems.product']);
        return response()->json($order);
    }

    public function update(Request $request, Order $order): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'sometimes|string|in:pending,processing,completed,cancelled'
        ]);

        $order->update($validated);
        $order->load(['user', 'orderItems.product']);
        return response()->json($order);
    }

    public function destroy(Order $order): JsonResponse
    {
        $order->delete();
        return response()->json(null, 204);
    }
}