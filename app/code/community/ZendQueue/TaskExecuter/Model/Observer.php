<?php  
class ZendQueue_TaskExecuter_Model_Observer {  
    public function executeTask() {
        Mage::helper('taskexecuter')->sendMessage();
        return 'task executed'; // optional -- for output in log / aoe_scheduler
    }  
}
