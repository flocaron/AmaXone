<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"> </script>
    <title><?php echo $pagetitle;?></title>
</head>
<body>
<main>
    <section>
        <?php
            require __DIR__ . "/{$cheminVueBody}";
        ?>
    </section>
</main>

<footer>
    <p id="foot">
       <h3 class="font-normal hover:font-bold">AmaXone ™ Inc.</h3>
    </p>
</footer>

</body>
</html>