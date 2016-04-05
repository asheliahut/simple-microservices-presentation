<?php

namespace UserSystem\Controllers

class UserController
{		
	private $userTable;
	private $userTableColumns = ['firstName','lastName','email'];
	
	public function setUserTable($userTable)
	{
		$this->userTable = $userTable;
	}
	
	public function getUserTable()
	{
		return $this->userTable;
	}
	
	public function __construct($userTable)
	{
		$this->userTable = $userTable;
	}
	
	public function readUser($request, $response, $args)
	{
		$id = (int)$args['id'];
		
		try { 
			$user = $this->getUserReturn($id);
			return $response->withJson(["success" => true, "message": "Found user $id", "data" => $user]);
		} catch(\Exception $e){
			return $response->withJson(["success" => false, "message" => "User not found"], 404);
		}
	}
	
	public function readAllUsers($request, $response, $args)
	{
		$users = $userTable->get();
		return $response->withJson(["success" => true, "message": "All users returned", "data" => $users]);
	}

	public function readAllUsersWithFilter($request, $response, $args)
	{
		$filter = $args['filter'];
		$value = $args['value'];
		
		try{
			$this->validateColumn($filter);
			$users = $this->getUserTable->where([$filter => $value]);
			if(empty($users)){
					return $response->withJson(["success" => true, "message": "No users found", "data" => $users], 404);
			}
			return $response->withJson(["success" => true, "message": "Filtered users by $filter", "data" => $users]);
			
		} catch(\Exception $e){
			return $response->withJson(["success" => false, "message" => "Error occured: ". $e->getMessage()]);
		}
	}
	
	public function createUser($request, $response, $args)
	{
		$userData = $request->getParsedBody();
		try{
			foreach($userData as $key => $val){
				$this->validateColumn($key);
			}
			$userId = $this->getUserTable()->insertGetId($userData);
			return $response->withJson(["success" => true, "message": "User $userid has been created."]);
		} catch(\Exception $e){
			return $response->withJson(["success" => false, "message" => "Error occured: ". $e->getMessage()], 400);
		}
	}
	
	public function updateUser($request, $response, $args)
	{
		$id = (int)$args['id'];
		$userData = $request->getParsedBody();
		try{
			$updateData = [];
			foreach($userData as $key => $val){
				$this->validateColumn($key);
				$updateData = array_merge($updateData, [$key => $val]);
			}
			$userId = $this->getUserTable()->update($updateData);
			
		} catch(\Exception $e){
			return $response->withJson(["success" => false, "message" => "Error occured: ". $e->getMessage()], 400);
		}
	}
	
	public function deleteUser($request, $response, $args)
	{
		$id = (int)$args['id'];
		
		try { 
			$user = $this->getUserReturn($id);
			$this->getUserTable()->delete($id);
			return $response->withJson(["success" => true, "message": "Deleted user $id"]);
		} catch(\Exception $e){
			return $response->withJson(["success" => true, "message" => "User not found"], 404);
		}
		
	}
	
	private function validateColumn($filter)
	{
		if(!in_array($filter, $this->userTableColumns)){
			throw new \Exception("$filter is not a valid filter option.");
		}
	}
	
	private function getUserReturn($id)
	{
		$user = $this->getUserTable()->find($id);
		if(empty($user))
		{
			throw new \Exception("User not found.");
		}
		return $user;
		
	}
	
	
}
