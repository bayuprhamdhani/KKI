<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Nota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row text-center">
            <h2>Laporan Penjualan</h2>
        </div>
        <div class="row">
            <table class="table table-striped" id="sellings">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NO TRX</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Cashier</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Total Item</th>
                        <th scope="col">Grand Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>

                    @foreach($sellings as $row)
                    <?php $no++ ?>
                    <tr>
                        <th scope="row">{{ $no }}</th>
                        <td>{{$row->code_trans}}</td>
                        <td>{{$row->date_sell}}</td>
                        <td>{{$row->cashier->name}}</td>
                        <td>{{$row->customer->name}}</td>
                        <td>{{$row->details->count()}}</td>
                        <td>{{$row->grand_total}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>