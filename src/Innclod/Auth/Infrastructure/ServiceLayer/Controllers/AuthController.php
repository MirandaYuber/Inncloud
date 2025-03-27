<?php

namespace Innclod\Auth\Infrastructure\ServiceLayer\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Innclod\Auth\Application\Interfaces\AuthServiceInterface;
use Innclod\Auth\Application\Mappers\LoginDtoMapper;
use Yuber\Http\Infrastructure\ServiceLayer\Controllers\BaseController;

class AuthController extends BaseController
{
    protected AuthServiceInterface $authService;

    public function __construct()
    {
        $this->initializeDependencies();
    }

    protected function initializeDependencies(): void
    {
        $this->authService = App::make(AuthServiceInterface::class);
    }

    public function auth(Request $request): mixed
    {

        return $this->useDbTransactions(false)
            ->execWithHttpResponse(function () use ($request) {
                $request->validate([
                    'email' => 'required|string|email',
                    'password' => 'required|string',
                ]);

                $this->authService->login(
                    (new LoginDtoMapper())->createFromRequest($request)
                );

                return redirect()->route('intranet');
            });
    }

    public function logout()
    {
        return $this->execWithHttpResponse(function () {
            auth()->logout();
            return redirect()->route('login');
        });
    }
}
