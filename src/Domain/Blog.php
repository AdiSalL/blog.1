<?php

namespace Pc\Blogapp\Domain;

class Blog {
    public ?int $id;
    public ?string $title;
    public ?string $content;
    public ?string $author;
    public ?string $created_at;
    public ?string $categories;
    public ?string $tags;
    
}