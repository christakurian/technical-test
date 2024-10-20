<?php

//Task 3 – Data Import - PHP

$filePath 		= 'technical-test-data.csv'; 
$exportDirPath	=	"upload/";

$finalDataArray	=	getVehicleDataFromCSV($filePath);

//export by fuel type
exportDataByFuelType($exportDirPath, $finalDataArray);

// check valid Registration
$registrationArray	=	checkRegistration($finalDataArray);

$validRegistrationArray		=	$registrationArray['valid'];
$notValidRegistrationArray	=	$registrationArray['notvalid'];


//print_r($validRegistrationArray);
//print_r($notValidRegistrationArray);
echo "Total invalid registrations:". count($notValidRegistrationArray);

//read CSV
function getVehicleDataFromCSV($filePath){
	
	if(($file = fopen($filePath, "r")) !== false) {
		
		$headerArray = fgetcsv($file);
		
		$dataArray	=	array();
		while (($row = fgetcsv($file)) !== false) {
			$dataArray[] = array_combine($headerArray, $row);
		}
		fclose($file);
		
		//remove any duplicates using the vehicle registration
		$finalDataArray	=	array();
		foreach($dataArray as $row){
			$finalDataArray[$row['Car Registration']]	=	$row;
		}
		
		return $finalDataArray;
	}
}

function exportDataByFuelType($exportDirPath, $finalDataArray){
	
	//filter by fuel type
	$fuelTypeArray	=	array();
	foreach ($finalDataArray as $row) {
		$fuelType = strtolower(str_replace(' ', '', trim($row['Fuel'])));
		$fuelTypeArray[$fuelType][]	=	$row;
	}
	
	//export each fuel type
	foreach ($fuelTypeArray as $fuelType => $vehiclesArray) {
		
		$exportFileName = $exportDirPath . $fuelType . '.csv';
		
		if(($file = fopen($exportFileName, "w")) !== false) {
			
			//header
			fputcsv($file, array_keys($vehiclesArray[0]));
			
			foreach ($vehiclesArray as $row) {
                fputcsv($file, $row);
            }
			
			fclose($file);
		}
	}
}
	
function checkRegistration($finalDataArray){	
	
	//check valid registration
	$result						=	array();
	$validRegistrationArray		=	array();
	$notValidRegistrationArray	=	array();
	foreach ($finalDataArray as $registrationNum => $row) {
		
		if(preg_match('/^[A-Z]{2}[0-9]{2}\s[A-Z]{3}$/', $registrationNum)){
			$validRegistrationArray[]	=	$row;
		}else{
			$notValidRegistrationArray[]	=	$row;
		}
	}
	
	$result['valid']	=	$validRegistrationArray;
	$result['notvalid']	=	$notValidRegistrationArray;
	
	return $result;
	
}	
	

?>