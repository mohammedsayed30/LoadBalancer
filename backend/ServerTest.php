<?php


/**
 * this server used  to create two back end servers for testing the load balamcer
 */

 class ServerTest
 {
    //hold the ipAddress of the back end server 
    private string $ipAddress;
    //hold whether the server is available to handle requests or not
    private bool $IsAvailable;
    //contstruct to initial the ipAddress and availability of the server
    function __construct(string $ipAddress){
        //assign the ipAddress of the server 
        $this->ipAddress = $ipAddress;
        //put the status of the server to be available at the begining
        $this->IsAvailable = true;
    }
    /**
     * this to get the ipAddress of the server
     * @param NULL
     * @return string the ipAddress of the server
     */
    public function getipAddress()
    {
        //return the server ipAddress 
        return $this->ipAddress;
    }

    /**
     * this to set  the status  of the server
     * @param bool status of the server
     * @return NULL
     */
    public function setAvailabilty(bool $status)
    {
        //set the status of the server
        $this->IsAvailable=$status;
    }

     /**
     * this to get  the status  of the server
     * @param NULL
     * @return bool status of the server
     */
    public function isAvailable()
    {
        //return the status of the server
        return $this->IsAvailable;
    }
    //to simulate the process of handling the requests
    public function handleRequest(string $request)
    {
        //check the server is available or not
        if($this->isAvailable()){
            echo "Request ". $request . " handled by Server " . $this->ipAddress . "\n";
        }else{
            echo "Server ". $this->ipAddress . " Is down". "\n";;
        }
    }

 }