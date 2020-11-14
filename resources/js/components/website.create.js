import { checkLoginDetails } from '../master-theme.service';

window.ftp = function() {
	return {
		apiToken: '39vzQuAWM0qxirkpfHLxziokKCIqwj7OrRLdYhNVFOBbTMqJWiNKrKtm58Ae',
		ftpUser: null,
		ftpPassword: null,
		checkingFtp: false,
		loginCheck: null,
		loginCheckLoading: false,

		onClickCheckLogin: function onClickCheckLogin(event) {
			event.preventDefault();

			this.loginCheck = null;
			this.loginCheckLoading = true;

			checkLoginDetails(this.ftpUser, this.ftpPassword, this.apiToken).then(res => {
				this.loginCheck = res;
				this.loginCheckLoading = false;
			});
		}
	};
};
