<table class="table table-bordered table-hover">
    <tr>
        <th><a href="javascript:;" onclick="changeSorting('name')">Product Name</a></th>
        <th><a href="javascript:;" onclick="changeSorting('price')">Product Price</a></th>
        <th></th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{$product['name']}}</td>
        <td>{{$product['price']}}</td>
        <td><button type="button" class="btn btn-success" onclick="buyProduct('{{$product['id']}}', '{{$product['name']}}')">Buy</button></td>
    </tr>
    @endforeach
</table>
