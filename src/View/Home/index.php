
<div class="max-w-full w-full flex items-center flex-col">

<div class="hero min-h-96">
  <div class="hero-content text-center">
    <div class="max-w-md">
        <h1 class="text-3xl font-bold">
            <?php echo $model["description"]; ?><br>
        </h1>
      <p class="py-6">
        Blog Programmer Yang Suka Dengan Berbagai Macam Hal Di Dunia Ini.
      </p>
    </div>
  </div>
</div>

    <div class="grid grid-cols-1 gap-x-5 md:grid-cols-4 mt-10 max-w-screen-2xl w-full px-5">
        <?php if (!empty($model["blogs"])): ?>
            <?php foreach ($model["blogs"] as $blog): ?>
                <div class="blog-post flex gap-5 flex-col flex-1">
                    <div class="header">
                        <h2 class="text-2xl font-bold"><?= htmlspecialchars($blog["title"]) ?></h2>
                    </div>
                    <div class="flex flex-row justify-between">
                        <p><strong></strong> <?= htmlspecialchars($blog["created_at"]) ?></p>
                        <p><strong>author:</strong> <?= htmlspecialchars($blog["author"]) ?></p>
                    </div>
                    <div class="max-w-content">
                        <a class="btn w-full" href="post/<?= htmlspecialchars($blog["id"])?>">Read More</a>
                    </div>
                </div>
       
            <?php endforeach; ?>
        <?php else: ?>
            <p>No blog posts available.</p>
        <?php endif; ?>
    </div>

</div>