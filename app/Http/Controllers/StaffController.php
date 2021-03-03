<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\StaffInterface;
use App\Models\User;
use Illuminate\Http\Request;


class StaffController extends Controller
{
    private $stuffInterface;

    public function __construct(StaffInterface $stuffInterface)
    {
        return $this->stuffInterface = $stuffInterface;
    }

    public function addStaff(Request $request)
    {
        return $this->stuffInterface->addStaff($request);
    }

    public function updateStaff(Request $request)
    {
        return $this->stuffInterface->updateStaff($request);
    }

    public function allStaff()
    {
        return $this->stuffInterface->allStaff();
    }

    public function deleteStaff(Request $request)
    {
        return $this->stuffInterface->deleteStaff($request);
    }
  public function specificStaff(Request $request){
        return $this->stuffInterface->specificStaff($request);

  }
}
