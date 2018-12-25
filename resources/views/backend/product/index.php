<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h4><?= $data['title'] ?></h4>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="<?= BASEURL ?>/product/create" class="btn btn-primary btn-md btn-block">Create New Product</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- end of card-header-->
            <div class="card-body">
                <div class="card-title mt-1">
                    <div class="col-md-12">
                        <form action="<?= BASEURL ?>/product/search" method="post">
                            <div class="input-group">
                                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search" value="<?= $data['keyword'] ?>" autocomplete="off">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary" id="search"> Search </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <table class="table table-striped table-light">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col" colspan="3" class="text-center">Setting</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['product'] as $product) {?>
                                <tr>
                                    <th scope="row"><?= $product['id'] ?></th>
                                    <td><?= $product['name'] ?></td>
                                    <td><?= $product['description'] ?></td>
                                    <td>Rp. <?php echo number_format($product['price'],2,',','.'); ?></td>
                                    <td><a href="<?= BASEURL ?>/product/show/<?= $product['id'] ?>" class="btn btn-primary btn-sm btn-block">Details</a></td>
                                    <td><a href="<?= BASEURL ?>/product/edit/<?= $product['id'] ?>" class="btn btn-success btn-sm btn-block">Edit</a></td>
                                    <td><a href="<?= BASEURL ?>/product/delete/<?= $product['id'] ?>" class="btn btn-danger btn-sm btn-block" onclick="return confirm('delete this product?');">Delete</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- end of card-body-->
        </div>
    </div>
</div>