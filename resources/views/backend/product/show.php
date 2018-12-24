<div class="row justify-content-center">
    <div class="col-md-6">
        <h3><?= $data['title'] ?></h3>
        <form action="<?= BASEURL ?>/product/store" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class = "form-control" required readonly value="<?= $data['product']['name'] ?>">
            <label for="description">Description:</label>
            <textarea name="description" id="description" cols="30" rows="10" required readonly class="form-control" type="input" ><?= $data['product']['description'] ?></textarea>
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" class = "form-control" required readonly value="<?= $data['product']['price'] ?>">
        </form>
    </div>
    <div class="col-md-4">
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <?php $created_at = date('M d, Y. h:ia', strtotime($data['product']['created_at'])); ?>
                    <strong>Created At :  </strong> <p class="ml-2"><?= $created_at ?></p>
                </div>
                <div class="row">
                    <?php $updated_at = date('M d, Y. h:ia', strtotime($data['product']['updated_at'])); ?>
                    <strong>Updated At :</strong> <p class="ml-2"><?= $updated_at ?></p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="<?= BASEURL ?>/product/edit/<?= $data['product']['id'] ?>" class="btn btn-primary btn-block btn-sm">Edit</a>
                    </div>
                    <div class="col-sm-6">
                        <a href="<?= BASEURL ?>/product/delete/<?= $data['product']['id'] ?>" class="btn btn-danger btn-block btn-sm" onclick="return confirm('delete this product?');">Delete</a>
                    </div>
                </div>
                <div class="row mt-3">
                    <a href="<?= BASEURL ?>/product/index" class="btn btn-dark btn-block btn-sm">&lt;&lt; All Product</a>
                </div>
            </div>
        </div>
    </div>
</div>