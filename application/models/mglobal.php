<?php
class mGlobal extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	function filter_by_value ($array, $index, $value){
    	$newarray = array();
        if(is_array($array) && count($array)>0) 
        {
            foreach(array_keys($array) as $key){
                $temp[$key] = $array[$key][$index];
                
                if ($temp[$key] == $value){
                    $newarray[$key] = $array[$key];
                }
            }
          }
      return $newarray;
    }
    
	function my_array_search($needle, $haystack) 
	{
        if (empty($needle) || empty($haystack)) {
            return false;
        }
       
        foreach ($haystack as $key => $value) {
            $exists = 0;
            foreach ($needle as $nkey => $nvalue) {
                if (!empty($value[$nkey]) && $value[$nkey] == $nvalue) {
                    $exists = 1;
                } else {
                    $exists = 0;
                }
            }
            if ($exists) return true;
        }
        return false;
    }
    
	function chkServer($host, $port)
	{  
	    $hostip = @gethostbyname($host); // resloves IP from Hostname returns hostname on failure
	   
	    if ($hostip == $host) // if the IP is not resloved
	    {
	        //echo "Server is down or does not exist";
	        return false;
	    }
	    else
	    {
	        if (!$x = @fsockopen($hostip, $port, $errno, $errstr, 5)) // attempt to connect
	        {
	            //echo "Server is down";
	            return false;
	        }
	        else
	        {
	           // echo "Server is up";
	           return true;
	            if ($x)
	            {
	                @fclose($x); //close connection
	            }
	        } 
	    }
	}
	
	function encrypt_password_md5($sData = '', $created_date = '')
    {
    	return md5('['.$sData.']['.$created_date.']');
    }
    
}
?>