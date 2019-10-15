<html>
<head>
    <title>
        <?php echo app('translator')->getFromJson("error.back_soon"); ?>
    </title>
    <style>
        body {
            background-color: #f9f9f9;
            color: #333;
            text-align: center;
            text-shadow: 0 1px 0 #fff;
            font-size: 1.8em;
        }
        .missing {
            width: 250px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 40px;
        }
    </style>
</head>
<body>
<div class="missing">
    <h2><?php echo app('translator')->getFromJson("error.back_soon"); ?></h2>
    <?php echo app('translator')->getFromJson("error.back_soon_description"); ?>
</div>
</body>
</html><?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/errors/500.blade.php ENDPATH**/ ?>