<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use Session;
class PageControllers extends Controller
{

    public function login()
    {
        Session::put('authPass',FALSE);
        $type = $_POST["type"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        $results = DB::select("select * from users where type='$type'");
        foreach ($results as $item){
            if ($item->username==$username&$item->password==$password) {
                Session::put('authPass', TRUE);
                Session::push('user.info', $item->name);
                Session::push('user.info', $item->type);
                Session::push('user.info', $item->project_id);
            }
        }

        if ( Session::get('authPass')==FALSE) {
            Session::flash('loginFail', 'Username or Password error!');
            return redirect()->back();
        }else {
            if (Session::get('authPass')==TRUE) {
                $userInfo = Session::get('user');
                return redirect('/dashboard');
            }

        }

    }
    public function logout()
    {
        Session::flush();
        return view('index');
    }
    public function dashboard()
    {
        $userInfo = Session::get('user');
        return view('dashboard')->with('userID',$userInfo['info'][1]);
    }

    public function upload(Request $request)
    {
        $pid = $_POST["pid"];
        $file1 = $request->file('jpgFile');
        $file2 = $request->file('pdfFile');

        $fileTypes = array('jpg','png','gif','JPG','PNG','GIF');
        $fileTypes= array('pfd','PDF');



        DB::table('project')
        ->where('project_id', $pid)
        ->update(array('status' => 1));
        if (Input::hasFile('jpgFile'))
        {
            $fileTypes = array('jpg','png','gif','JPG','PNG','GIF');
            $extension = $file1->getClientOriginalExtension();
            $isInFileType = in_array($extension,$fileTypes);
            if($isInFileType){
                $file1->move($pid,$pid.'.' .$file2->getClientOriginalExtension());
            }else{
            }
        }else {
            echo"nofile";
        }

        if (Input::hasFile('pdfFile'))
        {
            $fileTypes= array('pfd','PDF');
            $extension = $file2->getClientOriginalExtension();
            $isInFileType = in_array($extension,$fileTypes);
            if($isInFileType){
                $file1->move($pid,$pid.'.' .$file2->getClientOriginalExtension());
            }else{
                echo"123";
            }
        }else {
            echo"nofile";
        }

    }
}
