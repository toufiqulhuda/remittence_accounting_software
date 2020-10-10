<?php

function getBranchName($id) {
	$data = DB::table('branch')
        ->select('branch_name')
        ->where('branchid', $id)
        ->first();

    return $data->branch_name;
}

function getRoleName($id) {
	$data = DB::table('roles')
        ->select('role_name')
        ->where('roleid', $id)
        ->first();

    return $data->role_name;
}

function getCreatedBy($id) {
	$data = DB::table('users')
        ->select('username')
        ->where('user_id', $id)
        ->first();

    return $data->username;
}
 function menu($id)
    {
        

    }