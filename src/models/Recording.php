<?php 
namespace Nicosoft\Zoom\Recording;

class Recording{
	
	public $id;
	public $meetingid;
	public $filetype;
	public $download_url;
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getDownload_url(){
		return $this->download_url;
	}
	
	public function setDownload_url($download_url){
		$this->download_url = $download_url;
	}
	
	public function setFiletype(){
		$this->filetype = $filetype;
	}
	
	public function getFiletype(){
		return $this->filetype;
	}
}


?>