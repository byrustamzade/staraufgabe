<x-app-layout>
    @php
        $edit = !is_null($product->getKey());
        $add = is_null($product->getKey());
    @endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <style>
        .alert-danger {
            color: red !important;
        }

        .validate-label {
            border-color: red;
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
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    <form role="form" class="form-edit-add"
                          action="{{ $edit ? route('products.update', $product) : route('products.store') }}"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                    @if($edit)
                        @method('PUT')
                    @endif

                    <!-- CSRF TOKEN -->
                        @csrf

                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text"
                                           class="form-control"
                                           name="name" id="name" placeholder="Name"
                                           value="{{old('name', $product->name)}}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="brand">Brands</label>
                                    <select class="form-control select2" name="brand" id="brand">
                                        <option value="">Brands</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id}}"
                                                    @if((int)old('brand', $product->brand_id) === $brand->id) selected="selected"
                                                @endif
                                            >
                                                {{$brand->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input type="number" step="0.001"
                                           class="form-control"
                                           name="price" id="price" placeholder="Price"
                                           value="{{old('price', $product->price)}}">
                                </div>
                                <div class="form-group">
                                    <label for="yes">Is active</label><br>
                                    <input type="radio" id="yes" name="is_active" value="yes" @if($product->is_active) checked="checked" @endif>
                                    <label for="yes">Yes</label><br>
                                    <input type="radio" id="no" name="is_active" value="no" @if(!$product->is_active) checked="checked" @endif>
                                    <label for="no">No</label><br>
                                </div>
                            </div>
                        </div><!-- panel-body -->
                        <hr style="margin-bottom: 20px; margin-top: 20px;">
                        <div class="panel-footer">
                            <input type="submit" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
