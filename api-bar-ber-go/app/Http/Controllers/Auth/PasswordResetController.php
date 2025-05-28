<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\PasswordResetService;
use Illuminate\Http\JsonResponse;

class PasswordResetController extends Controller
{
    protected $passwordResetService;

    public function __construct(PasswordResetService $passwordResetService)
    {
        $this->passwordResetService = $passwordResetService;
    }

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        return $this->passwordResetService->sendResetToken($request->validated());
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        return $this->passwordResetService->resetPassword($request->validated());
    }
}
