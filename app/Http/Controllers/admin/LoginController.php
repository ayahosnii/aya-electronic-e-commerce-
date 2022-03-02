<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function getLogin()
    {
        return view('admin.auth.login');
    }


    public function login(LoginRequest $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;
        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input('password')], $remember_me)) {
        //notify()->success('تم الدخول بنجاح');
        return redirect() -> route('admin.dashboard');
    }

        //notify()->error('خطأ في البيانات برحاء المحاولة مجددا');
    return redirect()->back()->with(['error' => 'هناك خطأ بالبيانات']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
/*
 * Psy Shell v0.11.1 *
    public function save()
    {
        $admin = new App\Models\Admin();
        $admin -> name = "Aya Hosny";
        $admin -> email = "aya@gamil.com";
        $admin -> password = bcrypt("12345678");
        $admin -> save();
    }
*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
