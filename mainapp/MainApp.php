<?php

//namespace mainapp;

require_once  dirname(__DIR__). '/backend/ServerTest.php';
require_once  dirname(__DIR__) . '/loadbalancer/LoadBalancer.php';


class MainApp
{
    public function  run(){
        //create object from loadbalancer
        $loadBalancer = new LoadBalancer();

        //create back end servers ips
        $server1 = new ServerTest("198.168.50.1");
        $server2 = new ServerTest("198.168.50.2");
        $server3 = new ServerTest("198.168.50.3");
        $server4 = new ServerTest("198.168.50.4");

        //add the servers to the loadbalancer
        $loadBalancer->addServer($server1);
        $loadBalancer->addServer($server2);
        $loadBalancer->addServer($server3);
        $loadBalancer->addServer($server4);

        //simulate client  requests (assume 10 requests)
        for($i=1;$i<=10;$i++){
            $loadBalancer->distributeRequestToWebServers("Request" . $i);
        }

        //simulate if on busy
        $server3->setAvailabilty(false);
        for($i=1;$i<=10;$i++){
            $loadBalancer->distributeRequestToWebServers("Request" . $i);
        }
    }   
}