export const checkLoginDetails = async function checkLoginDetails(username, password, apiToken) {
	const response = await fetch(`http://smo-theme.test/api/check-login?api_token=${apiToken}&username=${username}&password=${password}`);
	const parsed = await response.json();

	return parsed;

}