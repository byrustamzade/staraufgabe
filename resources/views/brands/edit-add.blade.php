<x-app-layout>
    @php
        $edit = !is_null($brand->getKey());
        $add = is_null($brand->getKey());
    @endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brands') }}
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
                          action="{{ $edit ? route('brands.update', $brand) : route('brands.store') }}"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                    @if($edit)
                        @method('PUT')
                    @endif

                    <!-- CSRF TOKEN -->
                        @csrf

                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name:</label>
                                    <input type="text"
                                           class="form-control"
                                           name="name" id="name" placeholder="Name"
                                           value="{{old('name', $brand->name)}}">
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
