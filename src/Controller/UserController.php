<?php

namespace Pc\Blogapp\Controller;
use Pc\Blogapp\App\View;
use Pc\Blogapp\Model\UserRegisterRequest;
use Pc\Blogapp\Model\UserRegisterResponse;
use Pc\Blogapp\Model\UserLoginRequest;
use Pc\Blogapp\Model\UserLoginResponse;
use Pc\Blogapp\Repository\UserRepository;
use Pc\Blogapp\Repository\SessionRepository;
use Pc\Blogapp\Service\UserService;
use Pc\Blogapp\Service\SessionService;
use Pc\Blogapp\Database\Database;
use Pc\Blogapp\Exception\ValidationException;



class UserController {
    
    public UserService $userService;
    private SessionService $sessionService;

    public function __construct() {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);
        
        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    public function login() {
        View::render("User/login", []);
    }

    public function postLogin() {
        $login = new UserLoginRequest();
        $login->name = $_POST["username"];
        $login->password = $_POST["password"];
        try {
            $response = $this->userService->login($login);
            $this->sessionService->create($response->user->id);
            echo "<script>alert('Now Youare Logged In')</script>";
            View::redirect("/");
        }catch (ValidationException $exception) {
            View::render("User/login", 
        $model = [
                "error" => $exception->getMessage()
        ]);
        }

    }

    public function register() {
        View::render("User/register", []);
    }

    public function postRegister() {
        $register = new UserRegisterRequest();
        $register->name = $_POST['name'];
        $register->password = $_POST['password'];

        try {
            $this->userService->register($register);
            View::redirect("/user/login");

        }catch(ValidationException $exception){
            View::render("User/register", $model = [
                "error" => $exception->getMessage()
            ]);
        }
    }

    public function logout() {
        $this->sessionService->destroy();
        View::redirect("/");
    }
}