<x-app-layout>
  <x-slot name="header">
    @include('company.partials.list', ['companies' => $companies, 'title' => $company])
  </x-slot>
  <div x-data="websiteForm()" class="py-12">
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
                  <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    value="{{ $value }}" name="{{ $key }}">
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
          </div>
        </div>
        <div class="fixed bottom-0 left-0 w-full bg-white shadow">
          <input type="hidden" name="id" value={{ $form['id'] }}>  
          <div class="flex items-center justify-between max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
            <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" text="Submit Changes">
            @if(Session::has('message'))
              <p class="text-lg font-semibold text-green-500">{{ Session::get('message') }}</p>
            @endif
          </div>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>

