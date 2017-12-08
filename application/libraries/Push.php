<?php
 
 defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class Push {
 
    // push message title
    private $title;
    private $user_type;
    private $action;
    private $message;
    private $sender;
    private $image;
    // push message payload
    private $data;
    // flag indicating whether to show the push
    // notification or not
    // this flag will be useful when perform some opertation
    // in background when push is recevied
    private $is_background;
 
    function __construct() {
         date_default_timezone_set('Asia/Calcutta');
    }
 
    public function setTitle($title) {
        $this->title = $title;
    }
 
    public function setMessage($message) {
        $this->message = $message;
    }
    
    public function setSender($sender) {
        $this->sender = $sender;
    }    

    public function setImage($imageUrl) {
        $this->image = $imageUrl;
    }
 
    public function setPayload($data) {
        $this->data = $data;
    }

    public function setUsertype($user_type) {
    $this->user_type = $user_type;
    }

    public function setAction($action) {
    $this->action = $action;
    }
 
    public function setIsBackground($is_background) {
        $this->is_background = $is_background;
    }
 
    public function getPush() {
        $res = array();
        $res['data']['title'] = $this->title;
        $res['data']['is_background'] = $this->is_background;
        $res['data']['message'] = array("msg"=>$this->message,"sender"=>$this->sender);
        $res['data']['user_type'] = $this->user_type;
        $res['data']['action'] = $this->action;
        $res['data']['image'] = $this->image;
        $res['data']['payload'] = $this->data;
        $res['data']['timestamp'] = date('Y-m-d G:i:s');
        return $res;
    }
 
}