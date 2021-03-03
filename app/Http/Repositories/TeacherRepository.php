<?php

namespace App\Http\Repositories;


use App\Http\Interfaces\TeacherInterface;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Traits\GeneralTrait;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TeacherRepository implements TeacherInterface
{
    private $userModel;

    use ApiDesignTrait, GeneralTrait;


    public function __construct(User $user)
    {
        return $this->userModel = $user;
    }

    public function specificTeacher($request)
    {
        $validation = Validator::make($request->all(), [
            'teacher_id' => 'required|exists:users,id',
        ]);
        if ($validation->fails()) {
            return $this->generalValidation($validation);

        }
//        $is_staff = 1;
//        $staff = $this->staffCode($this->userModel, $request, $is_staff);
        $teacher = $this->userModel::whereHas('roleName', function ($q) {
            return $q->where('is_teacher', 1);

        })->with('roleName')->find($request->teacher_id);
        if ($teacher) {
            return $this->ApiResponse(200, 'get successfully', null, $teacher);

        };
        return $this->ApiResponse(404, 'no teacher valid');


    }


    public function addTeacher($request)
    {
        $valdation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'phone' => 'required',
            'status' => 'required',
            'role_id' => 'required|exists:roles,id',
        ]);
        if ($valdation->fails())
            return $this->generalValidation($valdation);

        $this->userModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'status' => $request->status,
            'role_id' => $request->role_id,

        ]);
        return $this->ApiResponse(200, 'teacher created successfully');
    }

    public function updateTeacher($request)
    {


        $valdation = Validator::make($request->all(), [
            'name' => 'required',
            'teacher_id' => 'required|exists:users,id',
            //'email'=>'required|unique:users,email'.$request->staff_id
            'email' => [
                'required',
                Rule::unique('users')->ignore($request->teacher_id),
            ],
            'password' => 'required',
            'phone' => 'required',
            'status' => 'required',
            'role_id' => 'required|exists:roles,id',
        ]);
        if ($valdation->fails())
            return $this->generalValidation($valdation);


        $teacher = $this->userModel::whereHas('roleName', function ($q) {
            return $q->where('is_teacher', 1);

        })->find($request->teacher_id);
        //$staff=$this->userModel::find($request->staff_id);

        if ($teacher) {
            $teacher->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'status' => $request->status,
                'role_id' => $request->role_id,

            ]);
            return $this->ApiResponse(200, 'teacher updated successfully');
        }
        return $this->ApiResponse(404, 'no teacher valid');


    }


    public function allTeacher()
    {

        $teacher = $this->userModel::whereHas('roleName', function ($q) {
            return $q->where('is_teacher',1);

        })->with('roleNAme')->get();





        if (count($teacher)>0)
            return $this->ApiResponse(200, 'all teacher', null, $teacher);

        return $this->ApiResponse(404, 'no teacher valid');

    }


    public function deleteTeacher($request)
    {
        $validation = Validator::make($request->all(), [

            'teacher_id' => 'required|exists:users,id'
        ]);
        if ($validation->fails())
            return $this->generalValidation($validation);

        $teacher = $this->userModel::whereHas('roleName', function ($q) {
            return $q->where('is_teacher', 1);

        })->find($request->teacher_id);
        //find return null or data object

        if ($teacher) {
            $teacher->delete();
            return $this->ApiResponse(200, 'deleted successfully');

        }
        return $this->ApiResponse(422, 'this user is not teacher');

    }



//    public function deleteStaff($request)
//    {
//        // $staff = $this->userModel->findOrFail($staff);
//        $staff = $this->userModel::find($request);
//        if ($staff) {
//            $staff->delete();
//
//            return $this->ApiResponse(200, 'staff deleted successfully');
//        } else {
//            return $this->ApiResponse(404, 'not found');
//        }
//
//
//    }


//    public function searchStaff($request)
//    {
//
//        $allStaff = $this->userModel::where('role_id', '!=', 1)->where(function ($q) use ($request) {
//            return $q->when($request->search, function ($query) use ($request) {
//                return $query->where('name', 'like', '%' . $request->search . '%')
//                    ->orWhere('email', 'like', '%' . $request->search . '%')
//                    ->orWhere('phone', 'like', '%' . $request->search . '%');
//            });
//        })->with('roleName')->latest()->paginate('3');
////use resource to control return data
//        if (count($allStaff) > 0) {
//            foreach ($allStaff as $Staff) {
//                $data [] = [
//                    'name' => $Staff->name,
//                    'email' => $Staff->email,
//                    'phone' => $Staff->phone,
//                    'status' => $Staff->status,
//                    'role_id' => $Staff->role_id,
//                    'role' => $Staff->roleNAme->name,
//                ];
//            }
//            return $this->ApiResponse(200, 'get all successfully', null, $data);
//        }
//        return $this->ApiResponse(404, 'no staff invalid');
//    }


}


