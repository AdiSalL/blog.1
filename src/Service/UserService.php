<?php

namespace Pc\Blogapp\Service;

use Pc\Blogapp\Domain\User;
use Pc\Blogapp\Repository\UserRepository;
use Pc\Blogapp\Database\Database;
use Pc\Blogapp\Model\UserLoginRequest;
use Pc\Blogapp\Model\UserLoginResponse;
use Pc\Blogapp\Model\UserRegisterRequest;
use Pc\Blogapp\Model\UserRegisterResponse;
use Pc\Blogapp\Exception\ValidationException;

class UserService {
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function validateUserRegisterRequest(UserRegisterRequest $request) {
        if ($request->name == null || $request->password == null || trim($request->name) == "" || trim($request->password) == "") {
            throw new ValidationException("Name, Password Can't Be Blank");
        }
    }

    public function register(UserRegisterRequest $request): UserRegisterResponse {
        $this->validateUserRegisterRequest($request);

        try {
            Database::beginTransaction();
            $user = $this->userRepository->findByName($request->name);

            if ($user != null) {
                throw new ValidationException("Username is already exists");
            }

            $user = new User();
            $user->name = $request->name;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);
            $user->role = "user";
            $this->userRepository->save($user);

            $response = new UserRegisterResponse();
            $response->user = $user;

            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function login(UserLoginRequest $request): UserLoginResponse {
        $this->validateUserLoginRequest($request);
        $user = $this->userRepository->findByName($request->name);
        if ($user == null) {
            throw new ValidationException("Name or Password is didnt exist");
        }

        if (password_verify($request->password, $user->password)) {
            $response = new UserLoginResponse();
            $response->user = $user;
            $response->password = $password;
            return $response;
        } else {
            throw new ValidationException("Name or Password is incorrect");
        }
    }

    private function validateUserLoginRequest(UserLoginRequest $request) {
        if ($request->name == null || $request->password == null) {
            throw new ValidationException("Name or Password can't be blank");
        }
    }
}
