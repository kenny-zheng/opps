<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class UserControllers extends Controller
{
    public function update()
    {
        $acctType = $_POST["acctype"];
        $uname = $_POST["username"];
        $psw = $_POST["password"];
        $nane = $_POST["name"];
        $email = $_POST["email"];

        DB::table('users')
            ->where('type', $acctType)
            ->where('username', $uname)
            ->update(array('password' => $psw,'email' => $email,'name' => $nane));
        Session::flash('update_info', 'update account sucessful!');
            if ($acctType==1) {
                return redirect('account/student');
            }
            if ($acctType==2) {
                return redirect('account/teacher');
            }
            if ($acctType==3) {
                return redirect('account/admin');
            }
    }

    public function create( $action)
    {
        $ins = $_POST["instructor"];
        $pid = $_POST["pid"];
        $pname = $_POST["pname"];
        $member = $_POST["member"];
        if ($action=="project") {
            DB::table('project')->insert(
                array('project_id' =>$pid, 'name' =>$pname, 'instructor' =>$ins)
            );
        foreach ($member as $value) {
            DB::table('users')
            ->where('username',$value)
            ->update(array('project_id' => $pid));
        }
        return redirect('project/view');
    }
        if ($action=="account") {
            echo"acc";
        }

    }

    public function timeset()
    {
        $ins = $_POST["std"];
        $pid = $_POST["ted"];
        $pname = $_POST["pjd"];
        echo"123";

    }
}
