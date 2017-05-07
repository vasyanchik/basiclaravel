<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <script>
            var boughtProducts = [];
            function loadProducts() {
				var sortBy = document.getElementById('productList').getAttribute('data-sort-by');
                var order = document.getElementById('productList').getAttribute('data-order');
                fetch('/api/products/'+sortBy+'/'+order)
                    .then(function(response) {
                        return response.text();
                    })
                    .then(function(html) {
                        document.getElementById('productList').innerHTML = html;
                    });
            }
            function buyProduct(id, name)
            {
                var options = {
                    method: 'POST',
                    headers: {}
                };
                fetch('/api/product/'+id+'/buy', options)
                    .then(function(response) {
						boughtProducts.push(name);
                    	loadProducts();
						document.getElementById('noBoughProducts').style.display='none';
						document.getElementById('boughProducts').style.display='block';
						var li = document.createElement("li");
						li.appendChild(document.createTextNode(name));
						document.getElementById('boughProductsList').appendChild(li);
                    });
            }
            function changeSorting(sortBy)
			{
				var newSortBy = sortBy;
				var newOrder = 'asc';
				if(sortBy == document.getElementById('productList').getAttribute('data-sort-by')){
					if(document.getElementById('productList').getAttribute('data-order') == 'asc'){
						newOrder = 'desc';
                    }
				}
                document.getElementById('productList').setAttribute('data-order', sortBy);
                document.getElementById('productList').setAttribute('data-order', newOrder);
                loadProducts();
			}
        </script>
    </head>
    <body>
    <div class="container">
        <h1>Laravel Test Project</h1>

        <div id="productList" data-sort-by="name" data-order="asc">

        </div>

        <div id="noBoughProducts">Buy some products please</div>
        <div id="boughProducts" style="display: none">
            Your Bough Products:
            <ul id="boughProductsList"></ul>
        </div>

    </div>
    <script>
        loadProducts();
    </script>
    </body>
</html>
