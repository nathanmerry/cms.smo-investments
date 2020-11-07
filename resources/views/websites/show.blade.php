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
          </div>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>

<script>
  function websiteForm() {
    return {
      colors: @php echo json_encode($data['form']['color']) @endphp,
      imageUrl: @php echo json_encode($data['form']['logo_url']) @endphp,      
    };
  }
</script>

