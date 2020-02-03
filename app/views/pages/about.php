<?php require APPROOT .'/views/inc/header.php'; ?>

<div class="starter-template text-center">
  <h1> <?php echo $data['title'] ?>  </h1>
  <p class="lead"> Version : <strong> <?php echo $data['about']; ?> </strong> .</p>
  <p class="lead"> Created By : <strong> <?php echo $data['created']; ?> </strong> .</p>

</div>


<?php require APPROOT .'/views/inc/footer.php'; ?>
