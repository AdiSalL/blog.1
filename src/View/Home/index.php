<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($model["title"]) ?></title>
    <style>
        nav {
            background-color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 10px 0;
        }

        nav h1 {
            color: white;
            text-align: center;
            margin: 0;
        }

        .content {
            padding: 20px;
        }

        .blog-post {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .blog-post h2 {
            margin-top: 0;
        }

        .blog-post p {
            margin-bottom: 5px;
        }

        .blog-post .author {
            font-style: italic;
        }
    </style>
</head>
<body>
    <nav>
        <h1>Selamat datang di <?= htmlspecialchars($model["title"]) ?></h1>
    </nav>

    <div class="content">
        <?php if (!empty($model["blogs"])): ?>
            <?php foreach ($model["blogs"] as $blog): ?>
                <div class="blog-post">
                    <h2><?= htmlspecialchars($blog->title) ?></h2>
                    <p><?= htmlspecialchars($blog->content) ?></p>
                    <p class="author"><strong>Author:</strong> <?= htmlspecialchars($blog->author) ?></p>
                    <p><strong>Posted on:</strong> <?= htmlspecialchars($blog->created_at) ?></p>
                    <p><strong>Category:</strong> <?= htmlspecialchars($blog->categories) ?></p>
                    <p><strong>Tags:</strong> <?= htmlspecialchars($blog->tags) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No blog posts available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
