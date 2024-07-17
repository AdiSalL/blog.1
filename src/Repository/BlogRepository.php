<?php

namespace Pc\Blogapp\Repository;
use Pc\Blogapp\Model\BlogResponse;
use Pc\Blogapp\Database\Database;



class BlogRepository {
    private \PDO $connection;
    
    public function __construct(\PDO $connection) {
        $this->connection = $connection ;
    }
    
    public $blogPosts = [];

    public function showAll():?BlogResponse {
        $statement = $this->connection->prepare("SELECT 
                posts.id AS post_id, 
                posts.title, 
                posts.content, 
                posts.author, 
                posts.created_at,
                categories.id AS category_id, 
                categories.name AS category_name, 
                tags.id AS tag_id, 
                tags.name AS tag_name
            FROM posts
            LEFT JOIN post_categories ON posts.id = post_categories.post_id
            LEFT JOIN categories ON post_categories.category_id = categories.id
            LEFT JOIN post_tags ON posts.id = post_tags.post_id
            LEFT JOIN tags ON post_tags.tags_id = tags.id
        
        ");
        $statement->execute();
        try {
            if($row = $statement->fetch()) {
          

                $blogPost = new BlogResponse();
                $blogPost->id = $row["post_id"]                                         ;
                $blogPost->title = $row["title"];
                $blogPost->content = $row["content"];
                $blogPost->author = $row["author"];
                $blogPost->created_at = $row["created_at"];
                $blogPost->categories = $row["category_name"];
                $blogPost->tags = $row["tag_name"];
           
                $blogPosts[] = $blogPost;
            }else {
                return null;
            }
    
            return $blogPost;
        }finally {
            $statement->closeCursor();
        }
    }

}