<?php 

namespace Nicosoft\Zoom\User;

class User{
  	public $firstname;
	public $lastname;
	public $email;
    public $id;
    
	function getFirstname() 
	{
		return $this->firstname;
	}
	function setFirstname($firstname) 
	{
		$this->firstname = $firstname;
	}
	function getLastname() 
	{
		return $this->lastname;
	}
	function setLastname($lastname) 
	{
		$this->lastname = $lastname;
	}
	function getEmail() 
	{
		return $this->email;
	}
	function setEmail($email) 
	{
		$this->email = $email;
	}
	
	function getId()
	{
		return $this->id;
	}
	
	function setId($id)
	{
		$this->id = $id;
	}
}

?>