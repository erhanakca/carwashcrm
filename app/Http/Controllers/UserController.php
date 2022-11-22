<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests\CompanyRequest;
use App\Http\Requests\UserRequests\EmailRequest;
use App\Http\Requests\UserRequests\NameSurnameRequest;
use App\Http\Requests\UserRequests\PasswordRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Repositories\Eloquent\UserRepository;



class UserController extends Controller
{
    protected int $user_id;
    protected User $user;
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository )
    {
        $this->user_id = auth()->user()->user_id;
        $this->user = User::find($this->user_id);
        $this->userRepository = $userRepository;
    }


    public function updateName(NameSurnameRequest $request): JsonResponse
    {
        try {
            return response()->json(['success' => true, 'data' => $this->userRepository->update($this->user_id, $request->validated())]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }

        /*$this->user_id = auth()->user()->user_id;
        $this->user = new User();
        $this->userRepository = new UserRepository($this->user);
        return response()->json(['data' => $this->userRepository->update($this->user_id, $request->validated())]);*/
    }

    public function updateCompany(CompanyRequest $request)
    {
        try {
            return response()->json(['success' => true, 'data' => $this->userRepository->update($this->user_id, $request->validated())]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }

    public function updateEmail(EmailRequest $request)
    {
        try {
            return response()->json(['success' => true, 'data' => $this->userRepository->update($this->user_id, $request->validated())]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }

    public function updatePassword(PasswordRequest $request)
    {
        try {
            return response()->json(['success' => true, 'data' => $this->userRepository->update($this->user_id, $request->validated())]);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 404);
        }
    }
}
