<x-app-layout>
	<x-slot name="header">
		@include('page.partials.list', ['pages' => $data, 'title' => 'Pages'])
	</x-slot>
</x-app-layout>