<!-- If message is set in the session then display that message -->
<?php if (isset($_SESSION['message'])) :  ?>
  <div class="msg <?php echo $_SESSION['type']; ?>">
    <li> <?php echo $_SESSION['message']; ?></li>
    <!-- Here we will remove message from session with unset function -->
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['type']);
    ?>
  </div>
<?php endif; ?>