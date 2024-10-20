
// Task 1 - Anagram – JavaScript 

function checkAnagrams(string1, string2) {
	
	// check if either string are empty
	if (!string1 || !string2) {
		return false;
	}
	
	//remove non alphabetic characters from both Strings
	const cleanedString1 = string1.replace(/[^a-zA-Z]/g, '');
	const cleanedString2 = string2.replace(/[^a-zA-Z]/g, '');
	
	const lowerString1 = cleanedString1.toLowerCase();
	const lowerString2 = cleanedString2.toLowerCase();
	
	//sort both strings
	const sortString1 = lowerString1.split('').sort().join('');
	const sortString2 = lowerString2.split('').sort().join('');
	
	if(sortString1 === sortString2){
		return true;
	}else{
		return false;
	}
}



const inputString1 = "Elbow";
const inputString2 = "Below";

const areAnagrams	=	checkAnagrams(inputString1, inputString2);

if(areAnagrams){
	document.write("Strings are anagrams!"); 
}else{
	document.write("Strings are not anagrams!"); 
}

