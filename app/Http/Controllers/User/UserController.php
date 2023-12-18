<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repository\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $users;
    public function __construct( UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        return $this->users->index();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        return $this->users->show($id);
    }




    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }

    public function x(){

        return 3;
    }
}
