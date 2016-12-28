# magento-zend-queue #
Magento starter module for implementing a simple messaging server based on Zend queue. 

## What does it do? ##
This module (upon modifying to fit your needs), executes queued tasks one by one in 2 minutes intervals. Task execution intervals can be changed as well as the number of tasks executed per interval.

## How to add tasks to queue? ##
Just add

Mage::helper('taskexecuter')->queueMessages($var);

Whereas $var contains data you would like to forward to your task function

## What will this then execute? ##
Currently it simply runs the sendMessage function in Helper/Data.php. You will need to fill this function with the code to be executed at each run.

## Can i add new queues? ##
Sure, just duplicate the queueMessage function in Helper/Data.php, change its name and change $this->\_name with a new queue name. Also you will need a new executer function, similarly duplicate sendMessage function, give it a new name and change $this->\_name with your new queue name. You will also need to modify Model/Observer.php to run your new function. If you wish to run the new queue parallel to your available queue, just add

Mage::helper('taskexecuter')->yourNewSendMessageFunction();

in the function executeTask.

In case you wish to create a new interval you will need to duplicate executeTask, give it a new name (let's call it executeTaskTwo) and change 

Mage::helper('taskexecuter')->sendMessage();
with 
Mage::helper('taskexecuter')->yourNewSendMessageFunction();

If you have decided to create a new interval you will also need to change ZendQueue/TaskExecuter/etc/config.xml. Add following under crontabs>jobs

<taskexecuter>
                <schedule><cron_expr>*/2 * * * *</cron_expr></schedule>
                <run><model>taskexecuter/observer::executeTaskTwo</model></run>
            </taskexecuter>



