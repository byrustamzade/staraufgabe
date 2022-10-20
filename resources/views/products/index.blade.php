<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }

        a {
            color: #2563eb;
            text-decoration: underline;
        }

        .alert-success {
            color: green;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    <a class="btn"
                       href="{{route('products.create')}}">
                        Add new product
                    </a>
                    <hr>
                    <table>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Is active</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    {{$product->name}}
                                </td>
                                <td>
                                    {{$product->brand->name}}
                                </td>
                                <td>
                                    {{$product->price}}
                                </td>
                                <td>
                                    {{$product->is_active ? 'Yes' : 'No'}}
                                </td>
                                <td>
                                    <a class="btn btn-blue"
                                       href="{{route('products.edit', $product)}}">
                                        Edit
                                    </a>
                                    <form action="{{route('products.destroy', $product)}}"
                                          method="post"
                                    >
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Delete" style="color: red">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
