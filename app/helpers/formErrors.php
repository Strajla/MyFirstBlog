<!-- Here we will test if there is errors using count function, if there is at least one error
 we are going to loop trough how many errors they are and we will display each of them in <li> list element 
 We accomplish this by using alternative syntax for control structures  -->

<?php if (count($errors) > 0) : ?>
    <div class="msg error">
        <?php foreach ($errors as $error) :  ?>
            <li><?php echo $error;  ?></li>
        <?php endforeach;  ?>
    </div>
<?php endif; ?>