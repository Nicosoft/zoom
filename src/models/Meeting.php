<?php 
namespace Nicosoft\Zoom\Meeting;

class Meeting{
	public $uuid;
	public $meeting_number;
	public $account_id;
	public $host_id;
	public $recording_count;
	
	public function setUuid($uuid){
		$this->uuid = $uuid;
	}
	
	public function getUuid(){
		return $this->uuid;
	}
	
	public function setMeeting_number($meeting_number){
		$this->meeting_number = $meeting_number;
	}
	
	public function getMeeting_number(){
		return $this->meeting_number;
	}
	
	public function setAccount_id($account_id){
		$this->account_id = $account_id;
	}
	
	public function getAccount_id(){
		return $this->account_id;
	}
	public function setHost_id($host_id){
		$this->host_id = $host_id;
	}
	
	public function getHost_id(){
		return $this->host_id;
	}
	
	public function getRecording_count(){
		return $this->recording_count;
	}
	
	public function setRecording_count($recording_count){
		$this->recording_count = $recording_count;
	}
}



?>