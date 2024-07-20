<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container max-w-screen-xl  mx-auto justify-center items-center max-h-screen h-full">
        <div class="mt-10">
            <div class="jumbotron">
                <img src="" alt="">
            </div>
        </div>
        <div>
            <h1 class="font-bold text-2xl"><?php echo $model["blogs"]->title?></h1>
            <div class="flex justify-between mt-2">
                <div class="flex flex-col justify-between ">
                    <i>author: <?= $model["blogs"]->author?></i>
                    <i>release date: <?= $model["blogs"]->created_at?></i>
                </div>
            </div>
            <div class="mt-10">
                <p><?php echo $model["blogs"]->content ?></p>
            </div>
        </div>

    </div>  
</body>
</html>