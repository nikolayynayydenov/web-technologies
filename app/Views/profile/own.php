<?php require_once(realpath(dirname(__FILE__) . '/../includes/header.php')); ?>

<div class="container">
    <div>
        <img src="/images/from_s3.png" alt="" height="200" width="200">
        <?= \App\Services\Auth::userLabel() ?>
    </div>

    <form action="/profile/avatar" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="patch"/>
        <input type="file" name="avatar">
        <input type="submit" value="Промяна на снимка">
    </form>

    <?php flashErrors(); ?>
</div>

<?php require_once(realpath(dirname(__FILE__) . '/../includes/footer.php')); ?>