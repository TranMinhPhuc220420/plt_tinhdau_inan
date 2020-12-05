<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dirape\Token\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $token = new Token();
        $user->PkUser_id = time();
        $user->User_Username = 'test';
        $user->User_Password = Hash::make('123_zxc');
        $user->User_FullName = 'Trần Minh Hoàng Test';
        $user->User_IsAdmin = true;
        $user->User_token = $token->randomString(100);
        $user->User_Email = 'test@plt.com.vn';
//        $user->save();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*
     * Return view login
     * */
    public function login(Request $request)
    {
        $dataResponse = ['loginFail' => false];
        $response = view('admin.layouts.login')->with(compact('dataResponse'));


        if ($request->cookie('remember_login')) {
            $response = redirect()->to('/admin/home');
        }

        if (session()->get('result_login')) {
            $dataResponse['loginFail'] = session()->get('result_login');
        }

        return $response;
    }

    public function submitLogin(Request $request)
    {
        $response = redirect()->to('/admin/login')->with('result_login', true);
        $username = $request->get('username');
        $password = $request->get('password');
        $remember = $request->get('remember');
        $admin = User::where('User_Email', $username)->get()->first();

        if ($admin) {
            $admin = $admin->toArray();
            if (Hash::check($password, $admin['User_Password'])) {

                $response = redirect()->to('/admin/home')
                    ->cookie('token', $admin['User_Token'], 3600)
                    ->cookie('remember_login', $remember ? $remember : false, 3600);
            }
        }

        return $response;
    }

    public function logout(Request $request)
    {
        $cookie = Cookie::forget('token');
        $cookie_rememberLogin = Cookie::forget('remember_login');

        return redirect()->to('/admin/login')
            ->withCookie($cookie)
            ->withCookie($cookie_rememberLogin);
    }
}
