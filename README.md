# magento-zend-queue #
Magento starter module for implementing a simple messaging server based on Zend queue. 

What does it do?
This module (upon modifying to fit your needs), executes queued tasks one by one in 2 minutes intervals. Task execution intervals can be changed as well as the number of tasks executed per interval.

How to add tasks to queue?

Mage::helper('taskexecuter')->queueMessages($var);

Whereas $var contains data you would like the forward to your task executing function

What will this then execute?
Currently it simply runs the 

