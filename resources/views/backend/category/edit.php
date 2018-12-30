<?php
    if (isset($_SESSION['request'])) {
        $value = \App\Core\Flasher::getRequest();
        $data['category']['name'] = $value['name'];
        $data['category']['parent_id'] = $value['parent_id'];
    }
?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <h3><?= $data['title'] ?></h3>
        <form action="<?= BASEURL ?>/category/update/<?= $data['category']['id'] ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class = "form-control" required value="<?= $data['category']['name'] ?>">
            <label for="parent_id">Parent Id:</label>
            <textarea name="parent_id" id="parent_id" cols="30" rows="10" class="form-control" type="input" ><?= $data['category']['parent_id'] ?></textarea>
            <input type="submit" value="Edit Category" class="btn btn-success btn-block btn-md mt-2">
        </form>
    </div>
</div>