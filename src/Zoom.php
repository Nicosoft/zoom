<?php

namespace Nicosoft\Zoom;

class Zoom{

    /*The API Key, Secret, & URL will be used in every function.*/
    private $api_key = 'Please Input Your Own API Key Here';
    private $api_secret = 'Please Input Your Own API Secret Here';
    private $api_url = 'https://api.zoom.us/v1/';

    function __construct($config=array()) {
                    
        if(empty($config)) {
            $this->loadConfigFile();
        } else {
            $this->api_key = $config['api_key'];
            $this->api_secret = $config['api_secret'];
            $this->api_url = $config['api_url'];
        }
    }
    
    
    private function loadConfigFile() {
        $config = parse_ini_file("config.ini");
        $this->api_key = $config['api_key'];
        $this->api_secret = $config['api_secret'];
        $this->api_url = $config['api_url'];
    }
    
    /*Function to send HTTP POST Requests*/
    /*Used by every function below to make HTTP POST call*/
    private function sendRequest($calledFunction, $data){
    	/*Creates the endpoint URL*/
    	$request_url = $this->api_url.$calledFunction;
    
    	/*Adds the Key, Secret, & Datatype to the passed array*/
    	$data['api_key'] = $this->api_key;
    	$data['api_secret'] = $this->api_secret;
    	$data['data_type'] = 'JSON';
    
    	$postFields = http_build_query($data);
    	/*Check to see queried fields*/
    	/*Used for troubleshooting/debugging*/
    	echo $postFields;
    
    	/*Preparing Query...*/
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    	curl_setopt($ch, CURLOPT_URL, $request_url);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    	$response = curl_exec($ch);
    
    	/*Check for any errors*/
    	$errorMessage = curl_exec($ch);
    	echo $errorMessage;
    	curl_clost($ch);
    
    	/*Will print back the response from the call*/
    	/*Used for troubleshooting/debugging		*/
    	echo $request_url;
    	var_dump($data);
    	var_dump($response);
    	if(!$response){
    		return false;
    	}
    	/*Return the data in JSON format*/
    	return json_encode($response);
    }
    /*Functions for management of users*/
	function createAUser($params=array()){		
		$createAUserArray = array();
		$createAUserArray['email'] = $params['email'];
		$createAUserArray['type'] = $params['type'];
		return $this->sendRequest('user/create', $createAUserArray);
	}   
	function autoCreateAUser($params=array()){
	  $autoCreateAUserArray = array();
	  $autoCreateAUserArray['email'] = $params['email'];
	  $autoCreateAUserArray['type'] = $params['type'];
	  $autoCreateAUserArray['password'] = $params['password'];
	  return $this->sendRequest('user/autocreate', $autoCreateAUserArray);
	}
	function custCreateAUser($params=array()) {
	  $custCreateAUserArray = array();
	  $custCreateAUserArray['email'] = $params['email'];
	  $custCreateAUserArray['type'] = $params['type'];
	  return $this->sendRequest('user/custcreate', $custCreateAUserArray);
	}  
	function deleteAUser($params=array()) {
	  $deleteAUserArray = array();
	  $deleteAUserArray['id'] = $params['id'];
	  return $this->sendRequest('user/delete', $deleteUserArray);
	}     
	function listUsers($params=array()) {
	  $listUsersArray = array();
	  return $this->sendRequest('user/list', $listUsersArray);
	}   
	function listPendingUsers($params=array()) {
	  $listPendingUsersArray = array();
	  return $this->sendRequest('user/pending', $listPendingUsersArray);
	}    
	function getUserInfo($params=array()) {
	  $getUserInfoArray = array();
	  $getUserInfoArray['id'] = $params['id'];
	  return $this->sendRequest('user/get',$getUserInfoArray);
	}   
	function getUserInfoByEmail($params=array()) {
	  $getUserInfoByEmailArray = array();
	  $getUserInfoByEmailArray['email'] = $params['email'];
	  $getUserInfoByEmailArray['login_type'] = $params['login_type'];
	  return $this->sendRequest('user/getbyemail',$getUserInfoByEmailArray);
	}  
	function updateUserInfo($params=array()) {
	  $updateUserInfoArray = array();
	  $updateUserInfoArray['id'] = $params['id'];
	  return $this->sendRequest('user/update',$updateUserInfoArray);
	}  
	function updateUserPassword($params=array()) {
	  $updateUserPasswordArray = array();
	  $updateUserPasswordArray['id'] = $params['id'];
	  $updateUserPasswordArray['password'] = $params['password'];
	  return $this->sendRequest('user/updatepassword', $updateUserPasswordArray);
	}      
	function setUserAssistant($params=array()) {
	  $setUserAssistantArray = array();
	  $setUserAssistantArray['id'] = $params['id'];
	  $setUserAssistantArray['host_email'] = $params['host_email'];
	  $setUserAssistantArray['assistant_email'] = $params['assistant_email'];
	  return $this->sendRequest('user/assistant/set', $setUserAssistantArray);
	}     
	function deleteUserAssistant($params=array()) {
	  $deleteUserAssistantArray = array();
	  $deleteUserAssistantArray['id'] = $params['id'];
	  $deleteUserAssistantArray['host_email'] = $params['host_email'];
	  $deleteUserAssistantArray['assistant_email'] = $params['assistant_email'];
	  return $this->sendRequest('user/assistant/delete',$deleteUserAssistantArray);
	}   
	function revokeSSOToken($params=array()) {
	  $revokeSSOTokenArray = array();
	  $revokeSSOTokenArray['id'] = $params['id'];
	  $revokeSSOTokenArray['email'] = $params['email'];
	  return $this->sendRequest('user/revoketoken', $revokeSSOTokenArray);
	}      
	function deleteUserPermanently($params=array()) {
	  $deleteUserPermanentlyArray = array();
	  $deleteUserPermanentlyArray['id'] = $params['id'];
	  $deleteUserPermanentlyArray['email'] = $params['email'];
	  return $this->sendRequest('user/permanentdelete', $deleteUserPermanentlyArray);
	}               
	/*Functions for management of meetings*/
	function createAMeeting($params=array()) {
	  $createAMeetingArray = array();
	  $createAMeetingArray['host_id'] = $params['host_id'];
	  $createAMeetingArray['topic'] = $params['topic'];
	  $createAMeetingArray['type'] = $params['type'];
	  return $this->sendRequest('meeting/create', $createAMeetingArray);
	}
	function deleteAMeeting($params=array()) {
	  $deleteAMeetingArray = array();
	  $deleteAMeetingArray['id'] = $params['id'];
	  $deleteAMeetingArray['host_id'] = $params['host_id'];
	  return $this->sendRequest('meeting/delete', $deleteAMeetingArray);
	}
	function listMeetings($params=array()) {
	  $listMeetingsArray = array();
	  $listMeetingsArray['host_id'] = $params['host_id'];
	  return $this->sendRequest('meeting/list',$listMeetingsArray);
	}
	function getMeetingInfo($params=array()) {
      $getMeetingInfoArray = array();
	  $getMeetingInfoArray['id'] = $params['id'];
	  $getMeetingInfoArray['host_id'] = $params['host_id'];
	  return $this->sendRequest('meeting/get', $getMeetingInfoArray);
	}
	function updateMeetingInfo($params=array()) {
	  $updateMeetingInfoArray = array();
	  $updateMeetingInfoArray['id'] = $params['id'];
	  $updateMeetingInfoArray['host_id'] = $params['host_id'];
	  return $this->sendRequest('meeting/update', $updateMeetingInfoArray);
	}
	function endAMeeting($params=array()) {
      $endAMeetingArray = array();
	  $endAMeetingArray['id'] = $params['id'];
	  $endAMeetingArray['host_id'] = $params['host_id'];
	  return $this->sendRequest('meeting/end', $endAMeetingArray);
	}
	function listRecording($params=array()) {
      $listRecordingArray = array();
	  $listRecordingArray['host_id'] = $params['host_id'];
	  return $this->sendRequest('recording/list', $listRecordingArray);
	}
	/*Functions for management of reports*/
	function getDailyReport($params=array()) {
	  $getDailyReportArray = array();
	  $getDailyReportArray['year'] = $params['year'];
	  $getDailyReportArray['month'] = $params['month'];
	  return $this->sendRequest('report/getdailyreport', $getDailyReportArray);
	}
	function getAccountReport($params=array()) {
	  $getAccountReportArray = array();
	  $getAccountReportArray['from'] = $params['from'];
	  $getAccountReportArray['to'] = $params['to'];
	  return $this->sendRequest('report/getaccountreport', $getAccountReportArray);
	}
	function getUserReport($params=array()) {
	  $getUserReportArray = array();
	  $getUserReportArray['user_id'] = $params['user_id'];
	  $getUserReportArray['from'] = $params['from'];
	  $getUserReportArray['to'] = $params['to'];
	  return $this->sendRequest('report/getuserreport', $getUserReportArray);
	}
	/*Functions for management of webinars*/
	function createAWebinar($params=array()) {
	  $createAWebinarArray = array();
	  $createAWebinarArray['host_id'] = $params['host_id'];
	  $createAWebinarArray['topic'] = $params['topic'];
	  return $this->sendRequest('webinar/create',$createAWebinarArray);
	}
	function deleteAWebinar($params=array()) {
	  $deleteAWebinarArray = array();
	  $deleteAWebinarArray['id'] = $params['id'];
	  $deleteAWebinarArray['host_id'] = $params['host_id'];
	  return $this->sendRequest('webinar/delete',$deleteAWebinarArray);
	}
	function listWebinars($params=array()) {
	  $listWebinarsArray = array();
	  $listWebinarsArray['host_id'] = $params['host_id'];
	  return $this->sendRequest('webinar/list',$listWebinarsArray);
	}
	function getWebinarInfo($params=array()) {
	  $getWebinarInfoArray = array();
	  $getWebinarInfoArray['id'] = $params['id'];
	  $getWebinarInfoArray['host_id'] = $params['host_id'];
	  return $this->sendRequest('webinar/get',$getWebinarInfoArray);
	}
	function updateWebinarInfo($params=array()) {
	  $updateWebinarInfoArray = array();
	  $updateWebinarInfoArray['id'] = $params['id'];
	  $updateWebinarInfoArray['host_id'] = $params['host_id'];
	  return $this->sendRequest('webinar/update',$updateWebinarInfoArray);
	}
	function endAWebinar($params=array()) {
	  $endAWebinarArray = array();
	  $endAWebinarArray['id'] = $params['id'];
	  $endAWebinarArray['host_id'] = $params['host_id'];
	  return $this->sendRequest('webinar/end',$endAWebinarArray);
	}
}
?>  