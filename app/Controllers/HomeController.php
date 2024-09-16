<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\UserModel;
use App\Models\UserCompanyModel;


class HomeController extends BaseController
{
    public function index(): string
    {
        helper(['form']);

        $userModel = new UserModel();
        $perPage = 10;
        $page = $this->request->getVar('page') ?: 1;
        $data['user_data'] = $userModel->getPaginatedAllUsers($perPage, $page);
        $data['pager'] = $userModel->pager;
        $data['header'] = 'Wszyscy Użytkownicy';

        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            view('Panels/side-bar').
            view('Panels/main', $data).
            view('Base/footer');
    }

    public function getActiveUsers(): string
    {
        helper(['form']);
        $userModel = new UserModel();
        $perPage = 10;
        $page = $this->request->getVar('page') ?: 1;
        $data['user_data'] = $userModel->getPaginatedANUsers($perPage, $page, 'y');
        $data['pager'] = $userModel->pager;
        $data['header'] = 'Aktywni Użytkownicy';

        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            view('Panels/side-bar').
            view('Panels/main', $data).
            view('Base/footer');
    }

    public function getUnactiveUsers(): string
    {
        helper(['form']);
        $userModel = new UserModel();
        $perPage = 10;
        $page = $this->request->getVar('page') ?: 1;
        $data['user_data'] = $userModel->getPaginatedANUsers($perPage, $page, 'n');
        $data['pager'] = $userModel->pager;
        $data['header'] = 'Nieaktywni Użytkownicy';

        return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            view('Panels/side-bar').
            view('Panels/main', $data).
            view('Base/footer');
    }

    public function getUserByName()
    {

        helper(['form']);
        $rules = [
            'name'  => 'required|min_length[2]|max_length[128]'
        ]; 

        if ($this->validate($rules)) { 
            $userModel = new UserModel();
            $perPage = 10;
            $page = $this->request->getVar('page') ?: 1;
            $data['user_data'] = $userModel->getUserByName(
                $this->request->getVar('name'),
                $perPage,
                $page
            );
            $data['pager'] = $userModel->pager;
            $data['header'] = 'Wyniki Wyszukiwania';

            return view('Base/header', [
                'title' => 'Panel Administracyjny'
            ]).
            view('Panels/side-bar').
            view('Panels/main', $data).
            view('Base/footer');            

        } else {
            return redirect()->to('/');
        }
    }
}