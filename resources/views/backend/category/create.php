<?php
    if (isset($_SESSION['request'])) {
        $value = \App\Core\Flasher::getRequest();
        $data['category']['name'] = $value['name'];
        $data['category']['parent_id'] = $value['parent_id'];
    }
    $view = new App\Core\View;
    $result = $view->getCategoryOption($data['category']['tree']);
?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <h3><?= $data['title'] ?></h3>
        <form action="<?= BASEURL ?>/category/store" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class = "form-control" required >
            <label for="parent_id">Parent Category:</label>
            <select class="custom-select">
                <option selected>Select Parent Category</option>
                <?= $result?>
            </select>
            <input type="submit" value="Create Category" class="btn btn-success btn-block btn-md mt-2">
        </form>
    </div>
</div>