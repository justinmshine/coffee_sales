<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="add-coffee-form" method="post" action="/sales/add/post">
                            @csrf
                            <div class="float-left">
                                <label for="first_name">Product</label><br>
                                <select name="coffee_id" id="coffee_id">
                                    @foreach ($coffees as $coffee)
                                        <option value="{{ $coffee->id }}">{{ $coffee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="float-left ml-12">
                                <label for="quantity">Quantity</label><br>
                                <input class="w-20" id="quantity" name="quantity" type="text">
                            </div>
                            <div class="float-left ml-12">
                                <label for="cost">Unit Cost (£)</label><br>
                                <input class="w-20" id="cost" name="cost" type="text">
                            </div>
                            <div class="float-left ml-12">
                                <label for="sales_price">Selling Price</label><br>
                                <input class="w-20" id="sales_price" name="sales_price" type="text">
                            </div>
                            <div class="float-left ml-12">
                                <input class="w-28 mt-6 p-2 border shadow" class="item-update" type="submit" value="Record Sale">
                            </div>
                        </form>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-20">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Previous Sales') }}
                    </h2>
                    <table>
                        {{ $sales }}
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
