<?php
class MyListener extends Doctrine_EventListener {
    public function onLoad(Doctrine_Record $record) {
        print $record->getTable()->getComponentName()." just got loaded!";
    }
    public function onSave(Doctrine_Record $record) {
        print "saved data access object!";
    }
}
class MyListener2 extends Doctrine_EventListener {
    public function onPreUpdate() {
        try {
            $record->set("updated",time());
        } catch(InvalidKeyException $e) { 
        }
    }
}


// setting global listener
$manager = Doctrine_Manager::getInstance();

$manager->setAttribute(Doctrine::ATTR_LISTENER,new MyListener());

// setting session level listener
$session = $manager->openSession($dbh);

$session->setAttribute(Doctrine::ATTR_LISTENER,new MyListener2());

// setting factory level listener
$table = $session->getTable("User");

$table->setAttribute(Doctrine::ATTR_LISTENER,new MyListener());
?>
