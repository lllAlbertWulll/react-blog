<?php

namespace App\Http\Controllers;

use Auth;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index()
    {
        return view('admin');
    }

    public function profile()
    {
        $admin = $this->adminRepository->findAdminById(Auth::id());
        return view('admin.personal.profile', compact('admin'));
    }

    public function profileUpdate(Request $request, $id)
    {
        $data = [
            'name' => $request->post('name'),
            'email' => $request->post('email')
        ];

        if ($request->file('avatar') != null) {
            $data['avatar'] = $request->file('avatar')->store('/uploads/'.date('Y-m-d', time()));
        }
        $admin = $this->adminRepository->findAdminById($id);
        $admin->update($data);

        return redirect('/admin/profile');
    }

    public function social()
    {
        return view('admin.personal.social');
    }

    public function passwordReset()
    {
        return view('admin.personal.password.reset');
    }
}
