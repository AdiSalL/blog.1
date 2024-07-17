<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        nav {
            background-color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;

        }

        nav h1 {
            color: white;
        }
    </style>
</head>
<body>
    <nav>
        <h1>Tulisan Adi Salafudin, Selamat datang di <?= $model["title"]?></h1>

    </nav>
</body>
</html>