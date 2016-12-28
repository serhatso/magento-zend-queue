<?php
class ZendQueue_TaskExecuter_Helper_Data extends Mage_Core_Helper_Abstract {
    protected $_name = "tasks";
    protected $_registry = array();
    protected $_queue = null;
    
    protected function getQueue() {
        if (!isset($this->_registry[$this->_name])) {
            
            $config  = Mage::getConfig()->getResourceConnectionConfig("default_setup");
            
            $queueOptions = array(
                Zend_Queue::NAME => $this->_name,
                'driverOptions' => array(
                    'host' => (string)$config->host,
                    //'port' => $db->port,
                    'username' => (string)$config->username,
                    'password' => (string)$config->password,
                    'dbname' => (string)$config->dbname,
                    'type' => 'pdo_mysql',
                    Zend_Queue::TIMEOUT => 1,
                    Zend_Queue::VISIBILITY_TIMEOUT => 1
                )
            );

            $this->_registry[$this->_name] = new Zend_Queue('Db', $queueOptions);
        }
        return $this->_registry[$this->_name];
    }
    public function sendMessage() {
        try {
            $this->_name = "tasks";
            
            $this->_queue = $this->getQueue();

            foreach ($this->_queue->receive() as $message) {
               
            /*

            E X E C U T E   T A S K
            
            */ 
	            
            }
            
        } catch (Exception $e) {
            Mage::logException($e);
            return -1;
        }
        return 1;
    }
    public function queueMessages($kuyruk) {
        if (isset($kuyruk)) {
            if (is_array($kuyruk) || is_object($kuyruk)) {
                $kuyruk = serialize($kuyruk);
            }
            $this->_name = "tasks";
            $this->getQueue()->send($kuyruk);
        }
        return $this;
    }
    
}
