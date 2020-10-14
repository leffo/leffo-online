<?php
/**
 *  @var object|null $data - массив входящих переменных
 */
?>
<?php include 'header.php'; ?>
<h3>Your request not found</h3>
<p><?= $data->getMessage(); ?></p>
<?php include 'footer.php'; ?>

