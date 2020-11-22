<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      @include('websites.partials.list', ['websites' => $data['websites'], 'title' => $data['website']])
			<a href="{{ route('create') }}" class="flex items-center opacity-50 hover:opacity-100">
        <svg class="w-4 h-4 mr-2" aria-hidden="true" focusable="false" data-prefix="far" data-icon="plus-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-plus-circle fa-w-16"><path fill="currentColor" d="M384 240v32c0 6.6-5.4 12-12 12h-88v88c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-88h-88c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h88v-88c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v88h88c6.6 0 12 5.4 12 12zm120 16c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-48 0c0-110.5-89.5-200-200-200S56 145.5 56 256s89.5 200 200 200 200-89.5 200-200z" class=""></path></svg>
        <span>Add Website</span>
      </a>
    </div>
  </x-slot>
  <div x-data="websiteForm()" class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form method="POST" action="/websites/save" enctype="multipart/form-data" class="pb-8">
        @csrf
        <div class="grid grid-cols-2 gap-4">
          <div>
            <div class="mb-4 p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="logo_filename">
                  Logo
                </label>
                <img class="mb-4" src={{ $data['form']['logo_url'] }}>
                <input type="file" name="logo_filename" value={{ $data['form']['logo_filename'] }} />
              </div>
            </div>
            <div class="mb-4 p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
              @foreach ($data['form']['website'] as $key => $value)
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $key }}">
                    {{ str_replace('_', ' ', $key) }}
                  </label>
                  <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    value="{{ $value }}" name="{{ $key }}">
                </div>
              @endforeach 
            </div>
            <div class="mb-4 p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
              @foreach ($data['form']['ctas'] as $key => $value)
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $key }}">
                    {{ str_replace('_', ' ', $key) }}
                  </label>
                  <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    value="{{ $value }}" name="{{ $key }}">
                </div>
              @endforeach 
            </div>
            <div class="mb-4 p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
              @foreach ($data['form']['images'] as $key => $value)
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $key }}">
                    {{ str_replace('_', ' ', $key) }}
                  </label>
                  <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    value="{{ $value }}" name="{{ $key }}">
                </div>
              @endforeach 
            </div>
            <div class="mb-4 p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
              @foreach ($data['form']['text'] as $key => $value)
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $key }}">
                    {{ str_replace('_', ' ', $key) }}
                  </label>
                  <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    value="{{ $value }}" name="{{ $key }}">
                </div>
              @endforeach 
            </div>
          </div>
          <div>
            <div class="mb-4 p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="company">
                Company
              </label>
              <select name="company">
                @foreach($data['form']['company']['all'] as $company)
                  <option
                    value="{{ $company->id }}"
                    @if($data['form']['company']['selected'])
                      {{ $data['form']['company']['selected'] === $company->id  ? 'selected' : ''}}
                    @endif
                  >
                    {{ $company->company_name }}
                  </option>
                @endforeach
              </select>            
						</div>
						<div class="mb-4 p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
              @foreach ($data['form']['ftp'] as $key => $value)
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $key }}">
                    {{ str_replace('_', ' ', $key) }}
                  </label>
									<input
										class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
										x-model="{{ $key }}"
										:value="{{ $key }}"
										name="{{ $key }}">
                </div>
							@endforeach 
							<div class="flex items-center justify-between flex-1">
								<button
									x-on:click="onClickCheckLogin(event)"
									class="bg-transparent hover:bg-gray-200 font-semibold py-2 px-4 border border-grey-500 rounded hover:shadow"
								>Test FTP connection</button>
								<div x-show="loginCheckLoading">
									<div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-6 w-6"></div>
								</div>
								<template x-if="loginCheck">
									<p 
										x-text="loginCheck.message" 
										class="font-bold"
										:class="{
											'text-red-500' : !loginCheck.success,
											'text-green-500' : loginCheck.success
										}"
									></p>
								</template>
							</div>
						</div>
            <div class="mb-4 p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
              @foreach ($data['form']['color'] as $key => $value)
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $key }}">
                    {{ str_replace('_', ' ', $key) }}
                  </label>
                  <div class="flex items-center">
                    <input
                      class="mr-1"
                      type="color"
                      x-model="colors.{{ $key }}"
                    >
                    <input type="text" x-model="colors.{{ $key }}" name="{{ $key }}">
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="fixed bottom-0 left-0 w-full bg-white shadow">
          <input type="hidden" name="ID" value={{ $data['form']['ID'] }}>  
          <div class="flex items-center justify-between max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
            <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" text="Submit Changes">
            @if(Session::has('message'))
              <p class="text-lg font-semibold text-green-500">{{ Session::get('message') }}</p>
            @endif
            <div
              x-on:click="displayPopup(event)"
              class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            >
              Delete Website
						</div>
          </div>
        </div>		
      </form>
      <template x-if="popup">
        <div class="fixed z-10 inset-0 overflow-y-auto">
          <form method="POST" action="/websites/delete">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
              <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
              </div>
              <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
              <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                      <h3 class="text-lg leading-6 font-medium text-gray-900">Are you sure you want to delete?</h3>
                      <div class="mt-2">
                        <p class="text-sm leading-5 text-gray-500">This action cannot be undone</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                  <input type="hidden" name="id" value={{ $data['form']['ID'] }}>  
                  <span class="mt-3 ml-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    <button class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none sm:text-sm sm:leading-5" type="submit">Delete</button>
                  </span>
                  <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    <button x-on:click="popup = false" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                      Cancel
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </form>
        </div>
      </template>
    </div>
  </div>
</x-app-layout>

<script>
  function websiteForm() {
    return {
			apiToken: '39vzQuAWM0qxirkpfHLxziokKCIqwj7OrRLdYhNVFOBbTMqJWiNKrKtm58Ae',
      colors: @php echo json_encode($data['form']['color']) @endphp,
      imageUrl: @php echo json_encode($data['form']['logo_url']) @endphp,   
			popup: false,

			ftp_username: @php echo json_encode($data['form']['ftp']['ftp_username']) @endphp,
			ftp_password: @php echo json_encode($data['form']['ftp']['ftp_password']) @endphp,
			loginCheckLoading: false,
			loginCheck: false,

      displayPopup(event) {
				event.preventDefault();
        this.popup = true;
			},

			onClickCheckLogin(event) {
				event.preventDefault();
				this.loginCheck = false;
				this.loginCheckLoading = true;

				this.checkLoginDetails(this.ftp_username, this.ftp_password, this.apiToken).then(res => {
					this.loginCheckLoading = false;
					this.loginCheck = res;
				})
			},
			
			async checkLoginDetails(username, password, apiToken) {
				const response = await fetch(`https://master-theme.cmlo.uk/src/check-login.php?api_token=${apiToken}&username=${username}&password=${password}`);
				const parsed = await response.json();

				return parsed;
			}
    }
  }
</script>

