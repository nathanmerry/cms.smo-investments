import { getAllWebsites, uploadSite, checkLoginDetails } from "../master-theme.service"

window.fileTransfer = function() {
	return {
		cmsApiToken: 'di9wkJLuLbhwALhKzIIVyseALOCUhBZIjRPDJbqlriDYqFBLsANtkFtt4Tx9',
		ftpApiToken: '39vzQuAWM0qxirkpfHLxziokKCIqwj7OrRLdYhNVFOBbTMqJWiNKrKtm58Ae',
		allSites: null,
		
		selected: [],
		allSelected: false,
		checked: [],

		sitesToUpload: [],
		popup: false,
		noSitesChose: false,

		popupHeader: 'Please confirm these are the sites you would like to upload:',
		popupSubHeader: null,
		popupApiResponse: [],


		popupLoginResponse: [],
		popupFilesResponse: [],		
		popupResponseMessage: [],		

		uploading: false,
		
		onClickOpenPopup: function onClickOpenPopup(event) {
			event.preventDefault();
			
			if (!this.checked.length) {
				this.noSitesChose = true;
			} else {
				this.popup = true;
				this.noSitesChose = false;
				this.sitesToUpload = this.allSites.filter(site => {
					return this.indexOf(this.checked, site.id) !== -1;
				})
			}
		},

		onClickStartUpload: function onClickStartUpload(index) {
			this.uploading = true;
			this.popupHeader = `Upload has began`;

			this.startUpload(-1);
		},

		startUpload(index) {
			index = index + 1;

			if (index < this.sitesToUpload.length) {
				const site = this.sitesToUpload[index];
				// this.sitesToUpload[index].ftp = {};

				this.checkFtpConn(site, index).then(() => {
					this.sitesToUpload[index].ftp
				})

				this.startUpload(index);
			} else {
				return;
			}
		}, 

		uploadToSite(index) {
		},
 

		async checkFtpConn(site, index) {
			this.popupSubHeader = `Checking ${site.website_short_address} FTP connection...`;

			if (!site.ftp_password || !site.ftp_username) {
				this.sitesToUpload[index].ftp.login = {success: false, message: 'please provide and ftp username and password'};
			} else {
				checkLoginDetails(site.ftp_username, site.ftp_password, this.ftpApiToken).then(res => {
					if (res.success) {
						this.sitesToUpload[index].ftp.login = {success: false, message: 'please provide and ftp username and password'};
					} else {
						this.sitesToUpload[index].ftp.login = res;
					}
				})
			}
			
			console.log(this.sitesToUpload[index].ftp)
		},

		fetchWebsites: function fetchWebsites(apiToken) {
			getAllWebsites(apiToken).then(res => this.allSites = res);
		},

		indexOf(array, item) {
			for (var i = 0; i < array.length; i++) {
				if (array[i].toString() === item.toString()) return i;
			}
				return -1;
		},
		
		selectAll: function selectAll() {
			this.checked = [];

			if (!this.allSelected) {
				this.allSites.forEach(site => {
					this.checked.push(site.id.toString())
				})
			}
		},

		select: function select() {
			this.allSelected = false;
		}

	};
};
