<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
 <a class="navbar-brand" href="<?php echo URLROOT; ?>">Share Posts</a>
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
 </button>

 <div class="collapse navbar-collapse" id="navbarsExampleDefault">
   <ul class="navbar-nav mr-auto">
     <li class="nav-item">
       <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
     </li>
     <li class="nav-item">
       <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">About Us</a>
     </li>

   </ul>

   <ul class="navbar-nav ml-auto">
     <!-- <li class="nav-item active">
       <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
     </li> -->
    <?php if(isset($_SESSION['user_id'])) :?>
       <li class="nav-item">
         <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Log Out</a>
       </li>
    <?php else : ?>
       <li class="nav-item">
         <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
       </li>
   <?php endif; ?>
   </ul>

 </div>
</nav>
