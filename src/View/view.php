<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.2.4/dist/cdn.min.js"></script>
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