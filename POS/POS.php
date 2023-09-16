<!DOCTYPE html>
<head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../styles.css" />
</head>
<!--<style>

</style>-->
<body>
    


    <div class="contranier mt-5">
    <div class="card colorbox">
                <div class="card-body ">
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Enter Product Code</h5>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Product Code" aria-label="Product Code" aria-describedby="basic-addon2">
                            </div>
                            <!--<button class="btn btn-danger mb-3 delete-selected">Delete Selected</button>-->
                        </div>
                    </div>

                    <!-- Collecting Products-->
                    <div class="table-responsive">
                        <table class="table shadow-sm table-bordered border-secondary">
                            <thead>
                                <tr>
                                    <th scope="col">QTY</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Amount</th>
                                    <!--<th scope="col">Action</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>20</td>
                                    <th scope="row">161262562</th>
                                    <td>7</td>
                                    <td>Chicaroon</td>
                                    <td>7</td>
                                    <td>49</td>
                                    <!--<td><input type="checkbox" class="product-checkbox"></td>-->
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <th scope="row">121526262</th>
                                    <td>2</td>
                                    <td>StickO</td>
                                    <td>29</td>
                                    <td>58</td>
                                    <!--<td><input type="checkbox" class="product-checkbox"></td>-->
                                </tr>
                                <tr>
                                    <td>16</td>
                                    <th scope="row">612242526</th>
                                    <td>9</td>
                                    <td>Nova</td>
                                    <td>15</td>
                                    <td>135</td>
                                    <!--<td><input type="checkbox" class="product-checkbox"></td>-->
                                </tr>
                            </tbody>
                        </table>
                    </div>
    
                    <!-- Calculation -->
                    <div class="col-md-6 offset-md-6">
                        <div class="border rounded p-3">
                            <h5>Summary</h5>
                            <table class="table border-secondary">
                                <tbody>
                                    <tr>
                                        <td>Subtotal:</td>
                                        <td>$242</td>
                                    </tr>
                                    <tr>
                                        <td>Discount:</td>
                                        <td>$0</td>
                                    </tr>
                                    <tr>
                                        <td>Grand Total:</td>
                                        <td>$242</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End Calculation -->
                </div>
            </div>
        </div>

</body>
</html>
