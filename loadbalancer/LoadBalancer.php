<?php
//namespace loadbalancer;

require_once dirname(__DIR__) . '/backend/ServerTest.php';


class LoadBalancer
{
    //to hold the servers
    private  $servers = [];
    //to hold the current server that should handle the currenct request
    private  $currentServer= 0;
    //contsructor
    function __construct(){
        //to hold the frist server
        $this->currentServer=0;
        //empty servers 
        $this->servers = [];
    }

    //add servertest 
    public function addServer(ServerTest $server){
        //add the back end server
        $this->servers[] = $server;
    }
    /**
     * this the main function of the load balancer to distribute the requests
     * to the servers based on the Round Robin Algorithm
     * @param string the request 
     * @return string fail or not 
     */
    public function distributeRequestToWebServers(string $request)
    {
        //hold the number of the servers
        $count = count($this->servers);
        //to hold the busy servers
        $serversFailNumber=0;
        //check whether there are availble servers or not 
        if(empty($this->servers)){
            echo "there is no availble servers to handle this request";
            return;
        }
        //this mean there still availble servers
        while($serversFailNumber < count($this->servers)){
            //to get the current server index
            $this->currentServer = $this->currentServer % $count;
            //get the actual object for this server
            $server = $this->servers[$this->currentServer ];
            //to move to the next server for the next time
            $this->currentServer=$this->currentServer+1;
            //check the availbility if this server
            if($server->isAvailable()){
                //handling the request 
                $server->handleRequest($request);
                return;           
            }
            //to indicate that server not available at the moment
            $serversFailNumber++;
        }
        //all server are busy
        echo "all servers are down";
        return;
    }
}