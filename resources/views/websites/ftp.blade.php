<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
			@include('websites.partials.list', ['websites' => $data, 'title' => 'Edit Website'])
			<a href="{{ route('create') }}" class="flex items-center opacity-50 hover:opacity-100">
        <svg class="w-4 h-4 mr-2" aria-hidden="true" focusable="false" data-prefix="far" data-icon="plus-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-plus-circle fa-w-16"><path fill="currentColor" d="M384 240v32c0 6.6-5.4 12-12 12h-88v88c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-88h-88c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h88v-88c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v88h88c6.6 0 12 5.4 12 12zm120 16c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-48 0c0-110.5-89.5-200-200-200S56 145.5 56 256s89.5 200 200 200 200-89.5 200-200z" class=""></path></svg>
        <span>Add Website</span>
      </a>
    </div>
	</x-slot>
	<div x-data="fileTransfer()" x-on:load.window="fetchWebsites('{{ Auth::user()->api_token }}')" class="py-12">
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
										x-on:click="selectAll"
										x-model="allSelected"
									>
									<span class="text-sm font-bold">
										Select All
									</span>
								</label>
								@foreach ($data as $item)
									<label class="md:w-2/3 block text-gray-500 font-bold">
										<input 
											class="ftp-checkbox mr-2 leading-tight"
											type="checkbox"
											value="{{ $item->id }}"
											x-model="checked"
											x-on:click="select"
										>
										<span class="text-sm">
											{{ $item->website_name }}
										</span>
									</label>	
								@endforeach
							</div>
							<div class="w-1/2 text-right">
								<button 
									x-on:click="onClickOpenPopup"
									class="w-3/4 mb-2 inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-green-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-400 focus:outline-none sm:text-sm sm:leading-5"
								>Upload Sites</button>
								<p x-show="noSitesChose" class="text-red-600 font-bold">Please choose a site!</p>
							</div>
						</div>
					</form>
					<template x-if="popup">
						<div class="fixed z-10 inset-0 overflow-y-auto">
							<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
								<div class="fixed inset-0 transition-opacity">
									<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
								</div>
								<span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
								<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
									<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
										<div class="sm:flex sm:items-start">
											<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
												<h3 class="text-lg leading-6 font-medium text-gray-900" x-text="popupHeader"></h3>
												<p x-show="popupSubHeader" class="pb-2 text-sm leading-5 text-gray-500" x-text="popupSubHeader">
												<div class="mt-2">
													<ul>
														<template x-for="(item, index) in sitesToUpload">
															<li class="flex items-center mb-3">
																{{-- <template x-if="uploading">
																	<template x-if="sitesToUpload[index].ftp.login === undefined">
																		<div class="mr-2">
																			<div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-4 w-4"></div>
																		</div>
																	</template>
																	<template x-if="sitesToUpload[index].ftp.login">
																		<template x-if="!sitesToUpload[index].ftp.login.success">
																			<div class="mr-2">
																				<svg x-show="popupLoginResponse[index].success == false" class="h-4 w-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
																					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
																				</svg> 
																			</div>
																		</template>
																		<template x-if="sitesToUpload[index].ftp.login.success">
																			<div class="mr-2">
																				<svg x-show="popupLoginResponse[index].success" aria-hidden="true" class="h-4 w-4 text-green-600" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
																					<path fill="currentColor" d="M466.5 83.7l-192-80a48.15 48.15 0 0 0-36.9 0l-192 80C27.7 91.1 16 108.6 16 128c0 198.5 114.5 335.7 221.5 380.3 11.8 4.9 25.1 4.9 36.9 0C360.1 472.6 496 349.3 496 128c0-19.4-11.7-36.9-29.5-44.3zM262.2 478.8c-4 1.6-8.4 1.6-12.3 0C152 440 48 304 48 128c0-6.5 3.9-12.3 9.8-14.8l192-80c3.9-1.6 8.4-1.6 12.3 0l192 80c6 2.5 9.9 8.3 9.8 14.8.1 176-103.9 312-201.7 350.8zm136.2-325c-4.7-4.7-12.3-4.7-17-.1L218 315.8l-69-69.5c-4.7-4.7-12.3-4.7-17-.1l-8.5 8.5c-4.7 4.7-4.7 12.3-.1 17l85.9 86.6c4.7 4.7 12.3 4.7 17 .1l180.5-179c4.7-4.7 4.7-12.3.1-17z" class=""></path>
																				</svg>
																			</div>
																		</template>
																	</template>
									
																	
																</template> --}}
																<div class="block">
																	<div class="block" x-text="item.website_name"></div>
																	<p class="text-sm text-red-600 italic">hello</p>
																</div>
															</li>
														</template>		
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
										<span class="mt-3 ml-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
											<button 
												x-on:click="onClickStartUpload(-1)"
												class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none sm:text-sm sm:leading-5"
												type="submit"
											>Upload</button>
										</span>
										<span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
											<button x-on:click="popup = false" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
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
</x-app-layout>

