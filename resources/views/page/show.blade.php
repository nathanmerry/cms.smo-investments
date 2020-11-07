<x-app-layout>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/3.4.25/jodit.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jodit/3.4.25/jodit.min.js"></script>

  <x-slot name="header">
    @include('page.partials.list', ['pages' => $pages, 'title' => $form['name']])
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form
        x-data="pageEditor()"
        x-on:load.window="initWysywig()"
        method="POST"
        action="/pages/save"
        class="joditEditor-wrap pb-8"
        :class="{
          'hidden': !display,
          'block': display
        }"
      >
        @csrf
        <textarea class="joditEditor" name="content"></textarea>
        <input type="hidden" name="slug" value="{{$form['slug']}}">
        <div class="fixed bottom-0 left-0 w-full bg-white shadow">
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
  function pageEditor() {
    return {
      display: false,
      text: @php echo json_encode($form['content']) @endphp,

      initWysywig() {
        var editor = new Jodit('.joditEditor', {
          height: 600,
          removeButtons: [
            'eraser', 'superscript', 'subscript', 'about', 'print', 'preview', 'copy', 'paste', 'cut', 'copyformat'
          ]
        });
        editor.value = this.text
        this.display = true;
      }
    }
  }
</script>