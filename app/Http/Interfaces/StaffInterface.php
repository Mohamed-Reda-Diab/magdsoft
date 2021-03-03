<?php

namespace App\Http\Interfaces;

interface StaffInterface
{

    public function addStaff($request);

    public function updateStaff($request);

    public function allStaff();

    public function deleteStaff($request);

    public function specificStaff($request);

    public function searchStaff($request);

}
