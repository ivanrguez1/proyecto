<?php if (count($errors) > 0) : ?>
    <div class="error">
        <?php echo "<p style='color:red'><strong>Errores:</strong></p>"; ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li style="color: red">
                    <p><?php echo "<p style='color:red'>" . $error . "</p>" ?></p>
                </li>
            <?php endforeach ?>
        </ul>
        <br>
    </div>
<?php endif ?>