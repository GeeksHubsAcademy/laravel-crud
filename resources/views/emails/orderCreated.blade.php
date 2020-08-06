<h1>Gracias {{$order->customer->name}}, Tu pedido {{$order->id}} ha sido creado</h1>

<div class="products" style="padding:0.8em">
    <table style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->products as $product)
            <tr style="
            width:100%;
    padding: 0.8em;
    border: 1px solid black;">
                <td> {{ $product->id }}</td>
                <img height="50px" src="{{$product->image_path}}" alt="imagen producto">
                <td> {{ $product->name }}</td>
                <td> {{ $product->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
