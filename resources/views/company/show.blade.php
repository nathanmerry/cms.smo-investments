<x-app-layout>
  <x-slot name="header">
    @include('company.partials.list', ['companies' => $companies, 'title' => $company])
  </x-slot>
  <div x-data="companyForm()" class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form method="POST" action="/companies/save" class="pb-8">
      @csrf
        <div class="grid grid-cols-2 gap-4">
          <div>
            <div class="mb-4 p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
              @foreach ($form['amount'] as $key => $value)
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
              @foreach ($form['company'] as $key => $value)
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
              @foreach ($form['home'] as $key => $value)
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $key }}">
                    {{ str_replace('_', ' ', $key) }}
                  </label>
                  <textarea
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="{{ $key }}"
                  >
                    {{ $value }}
                  </textarea>
                </div>
              @endforeach 
            </div>
          </div>
          <div>
            <div class="mb-4 p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
              @foreach ($form['misc'] as $key => $value)
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
              @foreach ($form['long-text'] as $key => $value)
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $key }}">
                    {{ str_replace('_', ' ', $key) }}
                  </label>
                  <textarea
                    class="shadow appearance-none border rounded w-full h-44 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="{{ $key }}"
                  >
                    {{ $value }}
                  </textarea>
                </div>
              @endforeach 
            </div>
          </div>
        </div>
        <div class="fixed bottom-0 left-0 w-full bg-white shadow">
          <input type="hidden" name="id" value={{ $form['id'] }}>  
          <div class="flex items-center justify-between max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
            <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" text="Submit Changes">
            @if(Session::has('message'))
              <p class="text-lg font-semibold text-green-500">{{ Session::get('message') }}</p>
            @endif
            <button
              x-on:click="displayPopup(event)"
              class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            >
              Delete Website
            </button>
          </div>
        </div>
      </form>
      <template x-if="popup">
        <div class="fixed z-10 inset-0 overflow-y-auto">
          <form method="POST" action="/companies/delete">
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
                  <input type="hidden" name="id" value={{ $form['id'] }}>  
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
  function companyForm() {
    return {
      popup: false,   

      displayPopup(event) {
				event.preventDefault();
        this.popup = true;
      }
    };

  }
</script>
