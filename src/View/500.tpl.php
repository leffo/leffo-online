<?php
/**
 * @var object|null $data - ошибка приложения.
 */
?>
<?php include 'header.php'; ?>
<h3>Хьюстон, у нас проблема!</h3>
<p><?= $data->getMessage(); ?></p>
<?php include 'footer.php'; ?>
