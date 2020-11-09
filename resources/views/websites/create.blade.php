<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between">
			@include('websites.partials.list', ['websites' => $websites, 'title' => 'Websites'])
			<a href="{{ route('create') }}" class="flex items-center opacity-50 hover:opacity-100">
				<svg class="w-4 h-4 mr-2" aria-hidden="true" focusable="false" data-prefix="far" data-icon="plus-circle"
					role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
					class="svg-inline--fa fa-plus-circle fa-w-16">
					<path fill="currentColor"
						d="M384 240v32c0 6.6-5.4 12-12 12h-88v88c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-88h-88c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h88v-88c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v88h88c6.6 0 12 5.4 12 12zm120 16c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-48 0c0-110.5-89.5-200-200-200S56 145.5 56 256s89.5 200 200 200 200-89.5 200-200z"
						class=""></path>
				</svg>
				<span>Add Website</span>
			</a>
		</div>
	</x-slot>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<form method="POST" action="/websites/store" class="pb-8">
				@csrf
				<div class="grid grid-cols-2 gap-4">
					<div class="mb-4 p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
						<div class="mb-4">
							<label class="block text-gray-700 text-sm font-bold mb-2">Website Name</label>
							<input
								class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
								name="website_name"
								value="{{ old('website_name') }}"
								required
							>
							@error('website_name')
								<p class="mt-3 text-red-600 italic">{{ $errors->first('website_name') }}</p>
							@enderror
						</div>
						<div class="mb-4">
							<label class="block text-gray-700 text-sm font-bold mb-2">Website Slug</label>
							<input
								class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
								placeholder="For CMS purposes only"
								name="website_slug"
								value="{{ old('website_slug') }}"
								required
							>
							@error('website_slug')
								<p class="mt-3 text-red-600 italic">{{ $errors->first('website_slug') }}</p>
							@enderror
						</div>
						<div class="mb-4">
							<label class="block text-gray-700 text-sm font-bold mb-2">Website Address (long)</label>
							<input
								class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
								placeholder="Ensure this is a perfect match to the actual site"
								name="website_address"
								value="{{ old('website_address') }}"
								required
							>
							@error('website_address')
								<p class="mt-3 text-red-600 italic">{{ $errors->first('website_address') }}</p>
							@enderror
						</div>
					</div>
				</div>
				<div class="fixed bottom-0 left-0 w-full bg-white shadow">
					<div class="flex items-center justify-between max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
						<input
							class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
							type="submit" text="Submit Changes"
						>
						@if(Session::has('message'))
							<p class="text-lg font-semibold text-green-500">{{ Session::get('message') }}</p>
						@endif
					</div>
				</div>
			</form>
			{{-- <template x-if="popup">
				<div class="fixed z-10 inset-0 overflow-y-auto">
					<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
						<div class="fixed inset-0 transition-opacity">
							<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
						</div>
						<span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
						<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
							<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
								<div class="sm:flex sm:items-start">
									<div x-show="loading" class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-6 w-6"></div>
									<div
										x-show="response" 
										:class="{
											'bg-red-100': !response.success,
											'bg-green-100': response.success 
										}"
										class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10"
									>
										<svg x-show="response.success" aria-hidden="true" class="h-6 w-6 text-green-600" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M466.5 83.7l-192-80a48.15 48.15 0 0 0-36.9 0l-192 80C27.7 91.1 16 108.6 16 128c0 198.5 114.5 335.7 221.5 380.3 11.8 4.9 25.1 4.9 36.9 0C360.1 472.6 496 349.3 496 128c0-19.4-11.7-36.9-29.5-44.3zM262.2 478.8c-4 1.6-8.4 1.6-12.3 0C152 440 48 304 48 128c0-6.5 3.9-12.3 9.8-14.8l192-80c3.9-1.6 8.4-1.6 12.3 0l192 80c6 2.5 9.9 8.3 9.8 14.8.1 176-103.9 312-201.7 350.8zm136.2-325c-4.7-4.7-12.3-4.7-17-.1L218 315.8l-69-69.5c-4.7-4.7-12.3-4.7-17-.1l-8.5 8.5c-4.7 4.7-4.7 12.3-.1 17l85.9 86.6c4.7 4.7 12.3 4.7 17 .1l180.5-179c4.7-4.7 4.7-12.3.1-17z" class=""></path></svg>
										<svg x-show="!response.success" class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
									</div>
									<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
										<h3 x-show="loading" class="text-lg leading-6 font-medium text-gray-900" x-text="loading.message"></h3>
										<h3 x-show="response.header" class="text-lg leading-6 font-medium text-gray-900" x-text="response.header"></h3>
										<div class="mt-2">
											<p x-show="response.message" class="text-sm leading-5 text-gray-500" x-html="response.message">
											<ul class="leading-5 text-gray-500">
												<template x-for="file in uploadedFiles">
													<li x-text="file"></li>
												</template>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
								<span x-show="ftp" class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
									<button x-on:click="onClickUpload()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none sm:text-sm sm:leading-5">
										Begin Upload
									</button>
								</span>
								<span x-show="ftpUploaded" class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
									<a x-show="response.slug" :href="response.slug" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none sm:text-sm sm:leading-5">
										Go to <span class="mx-1 font-semibold" x-text="websiteName"></span> customizer 
									</a>
								</span>
								<span x-show="!response.success" class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
									<button x-on:click="popup = false; response = false;" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
										Cancel
									</button>
								</span>
							</div>
						</div>
					</div>
				</div>				
			</template> --}}
		</div>
	</div>
</x-app-layout>

{{-- <script>
	function createWebsite() {
		return {
			apiToken: '39vzQuAWM0qxirkpfHLxziokKCIqwj7OrRLdYhNVFOBbTMqJWiNKrKtm58Ae',
			files: @php echo json_encode($ftpFiles) @endphp,
			websiteName: null,
			websiteSlug: null,
			ftpUser: null,
			ftpPassword: null,
			checkingFtp: false,
			loading: { message: '' },
			response: false,
			ftp: false,
			popup: false,
			uploadedFiles: [],
			ftpUploaded: false,

			async checkLoginDetails(username, password) {
				this.popup = true;
				this.loading.message = 'Checking FTP Information';
				const response = await fetch(`/api/check-ftp-login?api_token=${this.apiToken}&ftpUser=${username}&ftpPassword=${password}`);
				const parsed = await response.json();
				return parsed;
			},

			submit(event) {
				event.preventDefault();
				this.checkLoginDetails(this.ftpUser, this.ftpPassword).then(res => {
					this.response = res;
					this.ftp = res.success ? true : false;
					this.loading = false;
				});
			},

			onClickUpload() {
				this.response = false;
				this.ftp = false;
				this.loading = { message: 'Storing website in cms' };

				this.storeWebsite()
					.then(res => {
						if (res.success) {
							this.loading = { message: 'Site uploaded successfully - uploading files to ftp server...' };
							this.uploadFiles(-1);
						} else {
							this.loading = false;
							this.response = res;
						}
					})
			},

			uploadFiles(index) {
				index++;
				if (index <= this.files.length) {
					this.uploadFile(this.files[index])
						.then(res => res['files'] ? this.uploadedFiles = res['files'] : null)
						.then(() => this.uploadFiles(index));
				} else {
					this.loading = false;
					this.response = {
						'success': true,
						'header': 'Click below to start customizing',
						'slug': `${this.websiteSlug}/edit`,
					};

					console.log(this.response)
					this.ftpUploaded = true;
				}
			},

			async uploadFile(file) {
				return fetch(`/api/website-ftp`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            accept: "application/json",
          },
          body: JSON.stringify({
            api_token: this.apiToken,
            file: file,
            ftpUser: this.ftpUser,
            ftpPassword: this.ftpPassword,
          }),
				})
				.then(res => res.json()).then(jsonRes => {
					return jsonRes
				})
			},

			async storeWebsite(file) {
				return fetch(`/api/website-store`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            accept: "application/json",
          },
          body: JSON.stringify({
            api_token: this.apiToken,
            name: this.websiteName,
            slug: this.websiteSlug,
          }),
				})
				.then(res => res.json()).then(jsonRes => {
					return jsonRes
				})
			}
		}
	}
</script> --}}