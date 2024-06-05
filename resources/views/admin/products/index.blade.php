<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input type="text" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                        </div>
                        <div>
                            <a href="{{route('admin.products.create')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add Product</a>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($products) == 0)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td colspan="4" class="px-6 py-4 text-center"> -- No Data -- </td>
                                </tr>                                
                                @else
                                    @foreach ($products as $product)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{$product->name}}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{$product->product_category->name}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$product->price}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$product->description}}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <a href="{{route('admin.products.product-images.index', $product)}}" class="font-medium text-green-600 dark:text-green-500 hover:underline">Images</a>

                                                <a href="{{route('admin.products.edit', $product)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>

                                                <a x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete-confirmation-{{$product->id}}')" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>

                                                <x-modal name="delete-confirmation-{{$product->id}}" :shows="$errors->productDeletion->isNotEmpty()" focusable>
                                                    <form action="{{route('admin.products.destroy', $product)}}" method="POST" class="p-6 text-center">
                                                        @csrf
                                                        @method('DELETE')
                                                        <h2>Want Delete this product? {{$product->title}}</h2>
                                                        <div class="mt-6 flex justify-end">
                                                            <x-secondary-button x-on:click="$dispatch('close')">{{__('Cancel')}}</x-secondary-button>
                                                            <x-danger-button class="ms-3">{{__('Delete')}}</x-danger-button>
                                                        </div>
                                                    </form>
                                                </x-modal>
                                            </td>
                                        </tr>                                    
                                    @endforeach    
                                @endif                                                           
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4">
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
