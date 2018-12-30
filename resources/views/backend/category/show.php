<div class="row justify-content-center">
    <div class="col-md-6">
        <h3><?= $data['title'] ?></h3>
        <form action="<?= BASEURL ?>/category/store" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class = "form-control" required readonly value="<?= $data['category']['name'] ?>">
            <label for="parent_id">Parent Id</label>
            <textarea name="parent_id" id="parent_id" cols="30" rows="10" required readonly class="form-control" type="input" ><?= $data['category']['parent_id'] ?></textarea>
        </form>
    </div>
    <div class="col-md-4">
        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <?php $created_at = date('M d, Y. h:ia', strtotime($data['category']['created_at'])); ?>
                    <strong>Created At :  </strong> <p class="ml-2"><?= $created_at ?></p>
                </div>
                <div class="row">
                    <?php $updated_at = date('M d, Y. h:ia', strtotime($data['category']['updated_at'])); ?>
                    <strong>Updated At :</strong> <p class="ml-2"><?= $updated_at ?></p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="<?= BASEURL ?>/category/edit/<?= $data['category']['id'] ?>" class="btn btn-primary btn-block btn-sm">Edit</a>
                    </div>
                    <div class="col-sm-6">
                        <a href="<?= BASEURL ?>/category/delete/<?= $data['category']['id'] ?>" class="btn btn-danger btn-block btn-sm" onclick="return confirm('delete this category?');">Delete</a>
                    </div>
                </div>
                <div class="row mt-3">
                    <a href="<?= BASEURL ?>/category/index" class="btn btn-dark btn-block btn-sm">&lt;&lt; All Category</a>
                </div>
            </div>
        </div>
    </div>
</div>