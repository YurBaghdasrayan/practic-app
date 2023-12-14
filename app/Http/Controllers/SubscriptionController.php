<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$subscriptions = Plan::with('subscription')->get();
		return response()->json([
			'success' => true,
			'data' => $subscriptions
		]);
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
		DB::beginTransaction();
		try {
			$plan = Plan::create([
				'name' => $request->name,
				'description' => $request->description,
				'price' => $request->price,
			]);
			
			$subsciption = Subscription::create([
				'plan_id' => $plan->id,
				'user_id' => auth()->user()->id,
			]);
			
			DB::commit();
			return response()->json([
				'subscribe' => $subsciption,
				'success' => true,
				'message' => 'subscription created successfully'
			], 201);
			
		} catch (QueryException $e) {
			DB::rollBack($e->getMessage());
			return response()->json(['error' => 'Transaction failed: ' . $e->getMessage()], 500);
		}
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
