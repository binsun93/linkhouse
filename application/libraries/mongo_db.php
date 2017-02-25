<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mongo_db extends MX_Controller {

    public $mongodb;

    public function __construct() {
        $this->mongodb = $this->MongoConnectDb();
    }

    public function MongoConnect() {
        $conn = new MongoClient("mongodb://" . USERNAME_MONGO . ":" . PASSWORD_MONGO . "@" . HOST_MONGO . "/" . DATABASE_MONGO);
//        $conn = new Mongo('mongodb://118.69.202.37:27017', array(
//            'username' => 'hayhaytv_mgo',
//            'password' => 'dfpqnchfksfe$',
//            'db' => 'hayhaytv_mgo'
//        ));
        return $conn;
    }

    public function MongoConnectDb() {
        $conn = $this->MongoConnect();
        $db = $conn->selectDB(DATABASE_MONGO);
        return $db;
    }

    public function MongoDisconnect() {
        $this->MongoConnect()->close();
    }

    public function testConnect() {
//        print_r($this->mongodb->listCollections());
        $viewedLogs = $this->mongodb->test_perf;
        $cursor = $viewedLogs->find();
        print_r(iterator_to_array($cursor));
        $this->MongoDisconnect();
        exit;
    }

}

