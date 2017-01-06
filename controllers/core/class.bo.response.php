<?PHP

/*
  --------------------------------------------------------------------
  class.bo.response.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class boResponse {

    private $_vars = array();
    private $_headers = array();
    private $_body = '';

    public function addVar($key, $value) {
        $this->_vars[$key] = $value;
    }

    public function getVar($key) {
        return $this->_vars[$key];
    }

    public function setVar($key, $value) {
        $this->_vars[$key] = $value;
    }

    public function getVars() {
        return $this->_vars;
    }

    public function setBody($value) {
        $this->_body .= $value;
    }

    public function redirect($url, $permanent = false) {
        if ($permanent) {
            $this->_headers['Status'] = '301 Moved Permanently';
        } else {
            $this->_headers['Status'] = '302 Found';
        }
        $this->_headers['location'] = $url;
    }

    public function printOut() {
        foreach ($this->_headers as $key => $value) {
            header($key . ':' . $value);
        }
        echo $this->_body;
    }
}

?>