<?php

// Task 4 - Fizz Buzz - PHP

for ($i = 1; $i <= 100; $i++) {
    
	$result = "";

    if ($i % 3 == 0) {
        $result = "Fizz";
    }
	
    if ($i % 5 == 0) {
        $result .= "Buzz"; 
    }
    
    if ($result == "") {
        $result = $i;
    }

    echo $result . "<br>";
}

?>