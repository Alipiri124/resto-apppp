<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="flex justify-end m-2 p-2">
           <a href="{{route('admin.tables.create')}}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Table</a>
         </div> 
        
           <div class="overflow-x-auto relative">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                   Name
                </th>
                <th scope="col" class="py-3 px-6">
                    Guest
                </th>
                <th scope="col" class="py-3 px-6">
                    Status
                </th>
                <th scope="col" class="py-3 px-6">
                    Location
                </th>
            </tr>
        </thead>
        <tbody>
             @foreach($tables as $table)             
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$table->name}}
                </th>
                <td class="py-4 px-6">
                    {{$table->guest_number}}
                </td>
                <td class="py-4 px-6">
                    {{$table->status->name}}
                </td>
                <td class="py-4 px-6">
                    {{$table->location->name}}
                </td>
                <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <div class="flex space-x-2">
                    <a href="{{route('admin.tables.edit',$table->id)}}" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white">Edit</a>          
                    <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                    method="POST" 
                    action="{{route('admin.tables.destroy',$table->id)}}"
                    onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('Delete')
                    <button type="submit">Delete</button>                        
                    </form>
                    </div>
                </td> 
            </tr>
         @endforeach
        </tbody>
    </table>
</div>
    </div>
</x-admin-layout>