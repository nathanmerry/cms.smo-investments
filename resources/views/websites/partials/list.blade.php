<x-jet-dropdown align="left" width="48">
	<x-slot name="trigger">
		<button
			class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				@if ($title) 
					{{ __($title) }};
				@endif
			</h2>
			<div class="ml-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
		</button>
	</x-slot>
	<x-slot name="content">
		<div style="max-height: 70vh" class="overflow-scroll">
			@foreach($websites as $item)
					<a 
						class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" 
						href="/websites/{{$item['slug']}}/edit"
					>
						{{ __($item['name']) }}
					</a>
				<div class="border-t border-gray-100"></div>
			@endforeach
		</div>
	</x-slot>
</x-jet-dropdown>