<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="items-wrapper">
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
                            <label for="first_name">Product</label><br>
                            <select name="coffee_id" id="coffee_id">
                                @foreach ($coffees as $coffee)
                                    <option value="{{ $coffee->id }}">{{ $coffee->name }}</option>
                                @endforeach
                            </select><br><br>
                            <label for="quantity">Quantity</label><br>
                            <input id="quantity" name="quantity" type="text"><br><br>
                            <label for="cost">Unit Cost (£)</label><br>
                            <input id="cost" name="cost" type="text"><br><br>
                            <label for="sales_price">Selling Price</label><br>
                            <input id="sales_price" name="sales_price" type="text"><br><br>
                            <input class="item-update" type="submit" value="Record Sale">
                        </form>
                    </div>
                    <div class="sales-wrapper">
                        <table>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
