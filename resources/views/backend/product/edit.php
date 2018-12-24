<?php
    if (isset($_SESSION['request'])) {
        $value = \App\Core\Flasher::getRequest();
        $data['product']['name'] = $value['name'];
        $data['product']['description'] = $value['description'];
        $data['product']['price'] = $value['price'];
    }
?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <h3><?= $data['title'] ?></h3>
        <form action="<?= BASEURL ?>/product/update/<?= $data['product']['id'] ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class = "form-control" required value="<?= $data['product']['name'] ?>">
            <label for="description">Description:</label>
            <textarea name="description" id="description" cols="30" rows="10" required class="form-control" type="input" ><?= $data['product']['description'] ?></textarea>
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" class = "form-control" required value="<?= $data['product']['price'] ?>">
            <input type="submit" value="Edit Product" class="btn btn-success btn-block btn-md mt-2">
        </form>
    </div>
</div>