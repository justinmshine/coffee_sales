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

<script>
    let sales_options = document.querySelectorAll('#quantity, #cost');
    for (let i = 0; i < sales_options.length; i++) {
        sales_options[i].addEventListener('keyup', function(event) {
            let xhttp = new XMLHttpRequest();
            let token = '{{ csrf_token() }}';
            let coffee = document.getElementById('coffee_id').value;
            console.log(coffee);
            let quantity = document.getElementById('quantity').value;
            let cost = document.getElementById('cost').value;
            xhttp.open("POST", "/sales/calculate", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.setRequestHeader("X-CSRF-Token", token);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let response = JSON.parse(this.responseText);
                    let sales_price = document.getElementById('sales_price');
                    sales_price.setAttribute('value', response);
                }
            };
            xhttp.send("coffee=" + coffee + "&quantity=" + quantity + "&cost=" + cost);
        });
    }
</script>