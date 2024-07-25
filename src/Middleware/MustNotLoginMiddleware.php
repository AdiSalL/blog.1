<?php

namespace Pc\Blogapp\Middleware;
use Pc\Blogapp\Repository\SessionRepository;
use Pc\Blogapp\Repository\UserRepository;
use Pc\Blogapp\Service\SessionService;
use Pc\Blogapp\Database\Database;
use Pc\Blogapp\App\View;


class MustNotLoginMiddleware implements Middleware{

    private SessionService $sessionService;

    public function __construct() {
        $connection = Database::getConnection();
        $userRepository = new UserRepository( $connection );
        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository,$userRepository); 
    }

    function before(): void{
        $user = $this->sessionService->current();
        if($user != null) {
            View::redirect("/");
            exit();
        }
    }
    
}