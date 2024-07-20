<?php

namespace Pc\Blogapp\Domain;

class User {
    public ?int $id = null;
    public string $name;
    public string $password;
    public string $role;
}