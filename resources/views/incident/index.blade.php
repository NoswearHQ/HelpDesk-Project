<x-app-layout>
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container mx-auto px-6 py-2">
      
      <div class="text-center">
        <h3 class="text-gray-700 text-3xl font-medium">Incident</h3>  
      </div>  
          <div class="text-right">
            @can('Incident create')
              <a href="{{route('admin.incidents.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New Incident</a>
            @endcan
          </div>

        <div class="bg-white shadow-md rounded my-6">
          <table class="text-left w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Title</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Status</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-2/12">Creator</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right w-2/12">Actions</th>
              </tr>
            </thead>
            <tbody>
              @can('Incident access')
                @foreach($incidents as $incident)
                <tr class="hover:bg-grey-lighter">
                  <td class="py-4 px-6 border-b border-grey-light">{{ $incident->title }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">
   
                      @if($incident->closed)
                      <span class="text-white inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-green-500 rounded-full">Closed</span>
                      @else
                      <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-gray-500 rounded-full">Not Closed</span>
                      @endif
                  </td>
                  <td class="py-4 px-6 border-b border-grey-light">
                 {{\App\Models\User::where('id', '=', $incident->user_id)->first()->name;}}
                  </td> 
                  <td class="py-4 px-6 border-b border-grey-light text-right">

                    @can('Incident edit')
                    <a href="{{route('admin.incidents.edit',$incident->id)}}" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Treat</a>
                    @endcan

                    @can('Incident delete')
                    <form action="{{ route('admin.incidents.destroy', $incident->id) }}" method="POST" class="inline">
                        @csrf
                        @method('delete')
                        <button class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">Delete</button>
                    </form>
                    @endcan
                  </td>
                </tr>
                @endforeach
                @endcan
            </tbody>
          </table>

          @can('Incident access')
          <div class="text-right p-4 py-10">
            {{ $incidents->links() }}
          </div>
          @endcan
        </div>

      </div>
  </main>
</div>
</x-app-layout>
