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
                                <a href="<?= BASEURL ?>/category/create" class="btn btn-primary btn-md btn-block">Create New Category</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- end of card-header-->
            <div class="card-body">
                <div class="card-title mt-1">
                    <div class="col-md-12">
                        <form action="<?= BASEURL ?>/category/search" method="post">
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
                                <th scope="col">Parent Id</th>
                                <th scope="col" colspan="3" class="text-center">Setting</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['category'] as $category) {?>
                                <tr>
                                    <th scope="row"><?= $category['id'] ?></th>
                                    <td><?= $category['name'] ?></td>
                                    <td><?= $category['parent_id'] ?></td>
                                    <td><a href="<?= BASEURL ?>/category/show/<?= $category['id'] ?>" class="btn btn-primary btn-sm btn-block">Details</a></td>
                                    <td><a href="<?= BASEURL ?>/category/edit/<?= $category['id'] ?>" class="btn btn-success btn-sm btn-block">Edit</a></td>
                                    <td><a href="<?= BASEURL ?>/category/delete/<?= $category['id'] ?>" class="btn btn-danger btn-sm btn-block" onclick="return confirm('delete this category?');">Delete</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- end of card-body-->
        </div>
    </div>
</div>