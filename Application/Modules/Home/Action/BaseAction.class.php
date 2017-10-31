<?php
class BaseAction extends Action {

	function _empty(){
        header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码 
        $this->display('Mess/404'); 
    }

    public function __construct(){
        parent::__construct();
        $sessionId = session('sessionId');
        if (empty($sessionId)) {
        	$this->redirect('/Login');
        }
    }
}
