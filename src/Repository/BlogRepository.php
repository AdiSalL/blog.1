<?php

namespace Pc\Blogapp\Repository;
use Pc\Blogapp\Model\BlogResponse;
use Pc\Blogapp\Database\Database;
use Pc\Blogapp\Exception\ValidationException;




class BlogRepository {
    private \PDO $connection;
    
    public function __construct(\PDO $connection) {
        $this->connection = $connection ;
    }
    
    public $blogPosts = [];



    public function showById($id): ?BlogResponse {
        $statement = $this->connection->prepare("SELECT                
                posts.id AS post_id,
                posts.title, 
                posts.content, 
                posts.author, 
                posts.created_at,
                categories.id AS category_id, 
                categories.name AS category_names, 
                tags.id AS tag_id, 
                tags.name AS tag_names
            FROM posts 
            LEFT JOIN post_categories ON posts.id = post_categories.post_id
            LEFT JOIN categories ON post_categories.category_id = categories.id
            LEFT JOIN post_tags ON posts.id = post_tags.post_id
            LEFT JOIN tags ON post_tags.tags_id = tags.id WHERE posts.id = :id");
            $statement->bindParam(":id", $id);
            $statement->execute();
            try {
                if($rows = $statement->fetchAll(\PDO::FETCH_ASSOC)) {
                    foreach ($rows as $row) {
                        $blogPost = new BlogResponse();
                        $blogPost->id = $row["post_id"];
                        $blogPost->title = $row["title"];
                        $blogPost->content = $row["content"];
                        $blogPost->author = $row["author"];
                        $blogPost->created_at = $row["created_at"];
                        $blogPost->categories =  $row['category_names'];
                        $blogPost->tags =  $row['tag_names'];
                        
                   
                    }
                } else {
                    return null;
                }
                return $blogPost;
               
            } finally {
                $statement->closeCursor();
            }
    }

    public function getBlogs(): array {
        $statement = $this->connection->prepare("SELECT                
                posts.id AS post_id,
                posts.title, 
                posts.content, 
                posts.author, 
                posts.created_at,
                categories.name AS category_name, 
                tags.name AS tag_name
            FROM posts 
            LEFT JOIN post_categories ON posts.id = post_categories.post_id
            LEFT JOIN categories ON post_categories.category_id = categories.id
            LEFT JOIN post_tags ON posts.id = post_tags.post_id
            LEFT JOIN tags ON post_tags.tags_id = tags.id");
        
        $statement->execute();
        $queryResult = $statement->fetchAll(\PDO::FETCH_ASSOC);
    
        $blogs = []; // To store unique blog entries
    
        foreach ($queryResult as $row) {
            $blogId = $row['post_id'];
            
            if (!isset($blogs[$blogId])) {
                $blogs[$blogId] = [
                    'id' => $blogId,
                    'title' => $row['title'],
                    'content' => $row['content'],
                    'created_at' => $row['created_at'],
                    'author' => $row['author'],
                    'tags' => [],
                    'categories' => [],
                ];
            }
    
            // Collect tags and categories
            if (!empty($row['tag_name'])) {
                $blogs[$blogId]['tags'][] = $row['tag_name'];
            }
            if (!empty($row['category_name'])) {
                $blogs[$blogId]['categories'][] = $row['category_name'];
            }
        }
    
        // Convert associative array to indexed array
        return array_values($blogs);
    }
    

    public function showCategory() {
        $statement = $this->connection->prepare("SELECT * FROM categories");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function showTag() {
        $statement = $this->connection->prepare("SELECT * FROM tags");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function addPost($post, $categoryIds, $tagIds) {
        Database::beginTransaction();
        try {
            $statement = $this->connection->prepare("INSERT INTO posts (title, content, author) VALUES (:title, :content, :author)");
            $statement->execute([
                ":title" => $post["title"],
                ":content" => $post["content"],
                ":author" => $post["author"],
            ]);
            $postId =  $this->connection->lastInsertId();
            $categoryStatement = $this->connection->prepare("INSERT INTO post_categories (post_id, category_id) VALUES (:post_id, :category_id)");
            foreach($categoryIds as $categoryId){
                $categoryStatement->execute([
                    ":post_id" => $postId,
                    ":category_id" => $categoryId
                ]);
            };
            $tagsStatement = $this->connection->prepare("INSERT INTO post_tags (post_id, tags_id) VALUES (:post_id, :tag_id)");
            foreach($tagIds as $tagId){
                $tagsStatement->execute([
                    ":post_id" => $postId,
                    ":tag_id" => $tagId
                ]);
            };
            Database::commitTransaction();
        }catch(ValidationException $exception) {
            Database::rollbackTransaction();
            throw new $exception->getMessage();
        }

    }

}