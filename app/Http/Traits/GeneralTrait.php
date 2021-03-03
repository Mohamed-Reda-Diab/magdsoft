<?php

namespace App\Http\Traits;
use App\Models\User;

trait GeneralTrait
{

    private $user;

    public function __construct(User $user)
    {
        $this->user= $user;
    }

    public function generalValidation($n)
    {

            return $this->ApiResponse('422', 'validation error', $n->errors());


    }


}
