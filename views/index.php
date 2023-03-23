<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Home</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>

    <div>
        <?php if(! empty($invoice)): ?>
            Invoice ID: <?= htmlspecialchars($invoice['id'], ENT_QUOTES) ?> <br>
            Invoice Amount: <?= htmlspecialchars($invoice['amount'], ENT_QUOTES) ?> <br>
            User: <?= htmlspecialchars($invoice['full_name'], ENT_QUOTES) ?> <br>
        <?php endif ?>
    </div>

</body>
</html>

