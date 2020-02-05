<?php  if (count($errorListVar) > 0) : ?>
    <div class="error">
        <?php foreach ($errorListVar as $error) : ?>
            <p style="color: red"> <?php echo $error ?> </p>
        <?php endforeach ?>
    </div>
<?php  endif ?>