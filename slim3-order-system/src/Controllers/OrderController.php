<?php

namespace OrderSystem\Controllers;

class OrderController
{		
	private $orderTable;
	private $orderTableColumns = ['orderName','orderDetails','userId'];
	
	public function setOrderTable($orderTable)
	{
		$this->orderTable = $orderTable;
	}
	
	public function getOrderTable()
	{
		return $this->orderTable;
	}
	
	public function __construct($orderTable)
	{
		$this->orderTable = $orderTable;
	}
	
	public function readOrder($request, $response, $args)
	{
		$id = (int)$args['id'];
		
		try { 
			$order = $this->getOrderReturn($id);
			return $response->withJson(["success" => true, "message" => "Found order $id", "data" => $order]);
		} catch(\Exception $e){
			return $response->withJson(["success" => false, "message" => "Order not found"], 404);
		}
	}
	
	public function readAllOrders($request, $response, $args)
	{
		$orders = $orderTable->get();
		return $response->withJson(["success" => true, "message" => "All orders returned", "data" => $orders]);
	}

	public function readAllOrdersWithFilter($request, $response, $args)
	{
		$filter = $args['filter'];
		$value = $args['value'];
		
		try{
			$this->validateColumn($filter);
			$orders = $this->getOrderTable->where([$filter => $value]);
			if(empty($orders)){
				return $response->withJson(["success" => true, "message" => "No orders found", "data" => $orders], 404);
			}
			return $response->withJson(["success" => true, "message" => "Filtered orders by $filter", "data" => $orders]);
			
		} catch(\Exception $e){
			return $response->withJson(["success" => false, "message" => "Error occured: ". $e->getMessage()]);
		}
	}
	
	public function createOrder($request, $response, $args)
	{
		$orderData = $request->getParsedBody();
		try{
			foreach($orderData as $key => $val){
				$this->validateColumn($key);
			}
			$orderId = $this->getOrderTable()->insertGetId($orderData);
			return $response->withJson(["success" => true, "message" => "Order $orderId has been created."]);
		} catch(\Exception $e){
			return $response->withJson(["success" => false, "message" => "Error occured: ". $e->getMessage()], 400);
		}
	}
	
	public function updateUser($request, $response, $args)
	{
		$id = (int)$args['id'];
		$orderData = $request->getParsedBody();
		try{
			$updateData = [];
			foreach($orderData as $key => $val){
				$this->validateColumn($key);
				$updateData = array_merge($updateData, [$key => $val]);
			}
			$orderId = $this->getOrderTable()->update($updateData);
			return $response->withJson(["success" => true, "message" => "Updated order $id", "data" => $order]);
			
		} catch(\Exception $e){
			return $response->withJson(["success" => false, "message" => "Error occured: ". $e->getMessage()], 400);
		}
	}
	
	public function deleteOrder($request, $response, $args)
	{
		$id = (int)$args['id'];
		
		try { 
			$order = $this->getOrderReturn($id);
			$this->getOrderTable()->delete($id);
			return $response->withJson(["success" => true, "message": "Deleted order $id"]);
		} catch(\Exception $e){
			return $response->withJson(["success" => true, "message" => "Order not found"], 404);
		}
		
	}
	
	private function validateColumn($column)
	{
		if(!in_array($column, $this->orderTableColumns)){
			throw new \Exception("$column is not a valid column option.");
		}
	}
	
	private function getOrderReturn($id)
	{
		$order = $this->getOrderTable()->find($id);
		if(empty($order))
		{
			throw new \Exception("Order not found.");
		}
		return $order;
	}
	
	
}
