/* eslint-disable */
<template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="grid grid-cols-2 gap-4">
					<div class="mb-4 p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
						<form>
							<div class="flex">
								<div class="w-1/2">
									<label class="md:w-2/3 block text-gray-500 font-bold">
										<input
											class="ftp-checkbox mr-2 leading-tight"
											type="checkbox"
											@click="selectAll"
											v-model="allSelected"
										>
										<span class="text-sm font-bold">
											Select All
										</span>
									</label>
									<div 
										class="md:w-2/3 block text-gray-500 font-bold"
										v-for="item in websiteData" :key="item.id"
									>
										<input 
											class="mr-2 leading-tight"
											type="checkbox"
											:value="item.id"
											v-model="checked"
											@click="select"
										>
										<span class="text-sm">{{ item.website_name }}</span>
									</div>
								</div>
								<div class="w-1/2 text-right">
									<button 
										@click="onClickOpenPopup"
										class="w-3/4 mb-2 inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-green-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-400 focus:outline-none sm:text-sm sm:leading-5"
									>Upload Sites</button>
									<p v-if="noSitesChose" class="text-red-600 font-bold">Please choose a site!</p>
								</div>
							</div>
						</form>
						<template v-if="popup">
							<div class="fixed z-10 inset-0 overflow-y-auto">
								<!-- pt-4 px-4 pb-20 -->
								<div class="flex justify-center items-center min-h-screen text-center sm:p-0">
									<div class="fixed inset-0 transition-opacity">
										<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
									</div>
									<div style="max-height: 90vh" class="relative inline-block overflow-scroll align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
										<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
											<div class="sm:flex sm:items-start">
												<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
													<h3 class="text-lg leading-6 font-medium text-gray-900" x-text="popupHeader"></h3>
													<p v-if="popupSubHeader" class="pb-2 text-sm leading-5 text-gray-500">
														{{ popupSubHeader }}
													</p>
													<div class="mt-2">
														<ul>
															<li
																class="mb-3"
																v-for="(item, index) in sitesToUpload"
																:key="index"
															>
																<div class="flex items-center">
																	<template v-if="isUploading">
																		<div v-if="item.login.success === undefined" class="mr-2">
																			<div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-4 w-4"></div>
																		</div>
																		<div v-else-if="item.login.success" class="mr-2">
																			<svg aria-hidden="true" class="h-4 w-4 text-green-600" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M466.5 83.7l-192-80a48.15 48.15 0 0 0-36.9 0l-192 80C27.7 91.1 16 108.6 16 128c0 198.5 114.5 335.7 221.5 380.3 11.8 4.9 25.1 4.9 36.9 0C360.1 472.6 496 349.3 496 128c0-19.4-11.7-36.9-29.5-44.3zM262.2 478.8c-4 1.6-8.4 1.6-12.3 0C152 440 48 304 48 128c0-6.5 3.9-12.3 9.8-14.8l192-80c3.9-1.6 8.4-1.6 12.3 0l192 80c6 2.5 9.9 8.3 9.8 14.8.1 176-103.9 312-201.7 350.8zm136.2-325c-4.7-4.7-12.3-4.7-17-.1L218 315.8l-69-69.5c-4.7-4.7-12.3-4.7-17-.1l-8.5 8.5c-4.7 4.7-4.7 12.3-.1 17l85.9 86.6c4.7 4.7 12.3 4.7 17 .1l180.5-179c4.7-4.7 4.7-12.3.1-17z" class=""></path></svg>																
																		</div>
																		<div v-else-if="!item.login.success" class="mr-2">
																			<svg class="h-4 w-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg> 
																		</div>
																		<div v-if="item.ftp.success === undefined && item.login.success === undefined" class="mr-2">
																			<div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-4 w-4"></div>
																		</div>
																		<div v-if="item.ftp.success === false" class="mr-2">
																			<svg class="h-4 w-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg> 
																		</div>
																		<div v-if="item.ftp.success" class="mr-2">
																			<svg aria-hidden="true" class="h-4 w-4 text-green-600" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M466.5 83.7l-192-80a48.15 48.15 0 0 0-36.9 0l-192 80C27.7 91.1 16 108.6 16 128c0 198.5 114.5 335.7 221.5 380.3 11.8 4.9 25.1 4.9 36.9 0C360.1 472.6 496 349.3 496 128c0-19.4-11.7-36.9-29.5-44.3zM262.2 478.8c-4 1.6-8.4 1.6-12.3 0C152 440 48 304 48 128c0-6.5 3.9-12.3 9.8-14.8l192-80c3.9-1.6 8.4-1.6 12.3 0l192 80c6 2.5 9.9 8.3 9.8 14.8.1 176-103.9 312-201.7 350.8zm136.2-325c-4.7-4.7-12.3-4.7-17-.1L218 315.8l-69-69.5c-4.7-4.7-12.3-4.7-17-.1l-8.5 8.5c-4.7 4.7-4.7 12.3-.1 17l85.9 86.6c4.7 4.7 12.3 4.7 17 .1l180.5-179c4.7-4.7 4.7-12.3.1-17z" class=""></path></svg>																
																		</div>
																	</template>
																	<div class="block" x-text="item.website_name">{{ item.data.website_name }}</div>
																</div>
																<p
																	v-if="item.message"
																	class="text-sm italic"
																	:class="{
																		'text-red-600': item.message.success === false,
																		'text-green-600': item.message.success,
																		'text-grey-400': item.message.success === null
																	}"
																>{{ item.message.text }}</p>
																<p v-if="item.link" class="text-sm text-green-600 italic">
																	Files Uploaded - <a :href="'https://' + item.data.website_address" class="underline">{{ item.data.website_short_address }}</a> updated!						
																</p>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<div class="sticky bottom-0 bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
											<span class="mt-3 ml-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
												<button 
													@click="onClickStartUpload"
													class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none sm:text-sm sm:leading-5"
													type="submit"
												>Upload</button>
											</span>
											<span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
												<button @click="closePopup" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
													Cancel
												</button>
											</span>
										</div>
									</div>
								</div>
							</div>
						</template>
					</div>
				</div>
			</div>
    </div>
</template>

<script>
import { uploadSite, checkLoginDetails } from "../master-theme.service"

export default {
    name: "FtpUpload",

    data: () => ({
			apiToken: '39vzQuAWM0qxirkpfHLxziokKCIqwj7OrRLdYhNVFOBbTMqJWiNKrKtm58Ae',
			websiteData: [],
			selected: [],
			allSelected: false,
			checked: [],
			
			popup: false,
			noSitesChose: false,
			popupSubHeader: 'Please confirm these are the sites you would like to upload:',
			sitesToUpload: [],

			isUploading: false
		}),

		props: {
			websites: {
				type: String,
				required: true,
			}
		},

		methods: {
			select() {
				this.allSelected = false;
			},

			selectAll() {
				this.checked = [];
				if (!this.allSelected) {
					this.websiteData.forEach(site => {
						this.checked.push(site.id.toString())
					})
				}
			},

			onClickOpenPopup() {
				event.preventDefault();
				this.popupSubHeader = 'Please confirm these are the sites you would like to upload:';

				if (!this.checked.length) {
					this.noSitesChose = true;
				} else {
					this.popup = true;
					this.noSitesChose = false;
					this.sitesToUpload = this.websiteData.filter(site => {
						return this.indexOf(this.checked, site.id) !== -1;
					}).map(item => {
						return { data: item, login: {}, ftp: {}, message: {} }
					})
				}
			},

			closePopup() {
				this.isUploading = false;
				this.popup = false;
				this.sitesToUpload = [];
			},

			onClickStartUpload() {
				this.isUploading = true;
				this.startUpload(-1);
			},

			startUpload(index) {
				index++;

				if (index < this.sitesToUpload.length) {
					this.checkFtpConn(this.sitesToUpload[index], index).then(() => {
						if (this.sitesToUpload[index].login.success) {
							return this.uploadFiles(this.sitesToUpload[index], index)
						}
					}).then(() =>  {
						this.startUpload(index);
					})
				} else {
					return;
				}
			},

			async checkFtpConn(site, index) {
				this.popupSubHeader = ``;
				this.sitesToUpload[index].message = { success: null, text: 'checking ftp connection' };					

				if (site.data.ftp_password && site.data.ftp_username) {
					return checkLoginDetails(site.data.ftp_username, site.data.ftp_password, this.apiToken).then(res => {
						if (res.success) {
							this.sitesToUpload[index].login = { success: true, message: 'please provide and ftp username and password' };
							this.sitesToUpload[index].message = { success: true, text: 'ftp connect secure' };
						} else {
							this.sitesToUpload[index].login = false;
						}
					})
				} else {
					this.sitesToUpload[index].login = { success: false, message: 'please provide and ftp username and password' };
					this.sitesToUpload[index].message = { success: false, text: 'please provide and ftp username and password' };		
				}
			},

			async uploadFiles(site, index) {
				this.sitesToUpload[index].message = { success: null, text: 'FTP connection secured. Uploading files...' };

				return uploadSite(site.data.ftp_username, site.data.ftp_password, this.apiToken).then(res => {
					if (res.success) {
						this.sitesToUpload[index].ftp = { success: true, text: '' };
						this.sitesToUpload[index].message = null;
						this.sitesToUpload[index].link = true;
					}
				})
			},
 
			indexOf(array, item) {
				for (var i = 0; i < array.length; i++) {
					if (array[i].toString() === item.toString()) return i;
				}
				return -1;
			},
		},

		created() {
			try {
				this.websiteData = Object.values(JSON.parse(this.websites)).reverse();
			} catch(e) {
				console.log(e)
			}
		}
};
</script>

<style lang="scss"></style>
