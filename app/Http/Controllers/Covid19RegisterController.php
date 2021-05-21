<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class Covid19RegisterController extends Controller
{
    public function Register(Request $request)
    {
        /*   $data = User::create([
              'name' => $request->name,
              'email Address' => $request->email_Address,
              'Phone Number' => $request->Phone_Number,
              'password' =>Hash::make($request->password),
              'confirm password' =>Hash::make($request->confirm_password),
              'api_token' => Str::random(60),
          ]);
          return $data; */
        $rules =[
            'name' => 'required|max:191|string',
            'email Address' => 'required|max:191|unique:users|string',
            'Phone Number' =>'required|max:11|string',
            'password' => 'required|min:8|string',
            'confirm password' => 'required|min:8|string|confirmed'
        ];
        $messages =[
            'name.required' => 'الإسم مطلوب',
            'name.max' => 'الإسم مطلوب',
            'email Address.unique' => 'الإيميل موجود بالفعل الرجاء تغييره',
            'Phone Number.max'=> 'رقم الهاتف لا يقل عن 11 رقم ',
            'password.required'=>'الباسورد مطلوب',
            'password' => 'password:api',
            'confirm password.required'=>'الباسورد مطلوب'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return $validator->errors();
        }else{
            $data = User::create([
                'name' => $request->name,
                'email Address' => $request->email_Address,
                'Phone Number' => $request->Phone_Number,
                'password' =>Hash::make($request->password),
                'confirm password' =>Hash::make($request->confirm_password),
                'api_token' => Str::random(60),
            ]);
            return $data;
        }
    }
}
