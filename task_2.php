<?php

//Task 2 - IP filtering - PHP

function checkIpInRange($inputIp, $ipList) {
	
	$inputIp2Long = ip2long($inputIp);
	
	if(!$inputIp2Long){
		return false;
	}
	
	foreach($ipList as $ipRange){
		
		//CIDR
		if(strpos($ipRange, '/') !== false) {
			$cidrArray	=	explode('/', $ipRange);
			
			$cidrIp		=	$cidrArray[0];
			$cidrLength	=	$cidrArray[1];
			
			 // Find binary form
			$inputIpBinary 	= sprintf("%032b", ip2long($inputIp));      
			$cidrIpBinary 	= sprintf("%032b", ip2long($cidrIp)); 
			
			//get cidr length bits of both binary
			$inputIpBinaryFinal	=	substr($inputIpBinary, 0, $cidrLength);
			$cidrIpBinaryFinal	=	substr($cidrIpBinary, 0, $cidrLength);
			
			if($inputIpBinaryFinal == $cidrIpBinaryFinal){
				return true;
			}
			
		}
		// If range of IPs 
        elseif (strpos($ipRange, '-') !== false) {
			
            $ipRangeArray	= explode('-', $ipRange);
			
			$startIp		=	$ipRangeArray[0];
			$endIp			=	$ipRangeArray[1];
			
            $startIp2Long 	= ip2long(trim($startIp));
            $endIp2Long 	= ip2long(trim($endIp));

            // if input IP is in range
            if ($inputIp2Long >= $startIp2Long && $inputIp2Long <= $endIp2Long) {
                return true;
            }
        }
		else {
            
			$ipRangeLong = ip2long($ipRange);
			if ($inputIp2Long == $ipRangeLong) {
				return true;
			}
        }
	}
	
	return false;
}



$inputIp = '192.168.1.25';

$ipList = [
    '192.168.1.1',                
    '192.168.1.0-192.168.1.255',   
    '192.168.0.0/24',            
];

//For DB Integration

/* 

$mysqli = new mysqli('host', 'username', 'password', 'dbname');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$result = $mysqli->query("SELECT range FROM ip_ranges");

$ipList	=	array();
while ($row = $result->fetch_assoc()) {
	$ipList[] = $row['range'];
}

*/


$isIpInRange	=	checkIpInRange($inputIp, $ipList);

if($isIpInRange) {
    echo $inputIp. " is in the range.";
} else {
    echo $inputIp. " is not in the range.";
}

?>