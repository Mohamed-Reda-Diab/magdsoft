<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\TeacherInterface;
use App\Models\User;
use Illuminate\Http\Request;


class TeacherController extends Controller
{
    private $TeacherInterface;

    public function __construct(TeacherInterface $teacherInterface)
    {
        return $this->TeacherInterface = $teacherInterface;
    }

    public function addTeacher(Request $request)
    {
        return $this->TeacherInterface->addTeacher($request);
    }

    public function updateTeacher(Request $request)
    {
        return $this->TeacherInterface->updateTeacher($request);
    }

    public function allTeacher()
    {
        return $this->TeacherInterface->allTeacher();
    }

    public function deleteTeacher(Request $request)
    {
        return $this->TeacherInterface->deleteTeacher($request);
    }
  public function specificTeacher(Request $request){
        return $this->TeacherInterface->specificTeacher($request);

  }
}
