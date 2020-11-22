export const checkLoginDetails = async function checkLoginDetails(username, password, apiToken) {
	const response = await fetch(`https://master-theme.cmlo.uk/src/check-login.php?api_token=${apiToken}&username=${username}&password=${password}`);
	const parsed = await response.json();

	return parsed;
}

 export const uploadSite = async function checkLoginDetails(username, password, apiToken) {
 	const response = await fetch(`https://master-theme.cmlo.uk/src/files.php?api_token=${apiToken}&username=${username}&password=${password}`);
	 const parsed = await response.json()
	 
	 return parsed;
}
 
export const getAllWebsites = async function getAllWebsites(apiToken) {
	const response = await fetch(`/api/websites/index/?api_token=${apiToken}`);
	const parsed = await response.json();
	
	return parsed;
}

