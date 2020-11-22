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
	{{-- x-on:load.window="fetchWebsites('{{ Auth::user()->api_token }}')" --}}

	{{-- {{dump(json_encode($data))}} --}}
		<div id="ftp-upload">
			<ftp-upload websites="{{ json_encode($data) }}" />
			{{-- <ftp-upload websites="hello" /> --}}
		</div>
	</div>
</x-app-layout>

