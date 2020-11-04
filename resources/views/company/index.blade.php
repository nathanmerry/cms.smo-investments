<x-app-layout>
	<x-slot name="header">
		@include('company.partials.list', ['companies' => $data, 'title' => 'Companies'])
	</x-slot>
</x-app-layout>