<?php

namespace App\Libraries;

use App\Models\UserModel;
use App\Models\UserCompanyModel;
use App\Models\UserLoginModel;
use App\Libraries\FormatLibrary;

class EmployeeLibrary
{
    private UserModel $userModel;
    private UserCompanyModel $userCompanyModel;
    private UserLoginModel $userLoginModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userCompanyModel = new UserCompanyModel();
        $this->userLoginModel = new UserLoginModel();
    }

    public function getEmployees(
        string $type = null,
        \stdClass $company = null
    ): array
    {
        $users = $this->userModel->getUsers($type);
        $companies = $this->userCompanyModel->getUsersCompany();
        $logins = $this->userLoginModel->getUsersLogin();

        if (empty($company)) {
            return [
                'users' => $users,
                'companies' => $companies,
                'logins' => $logins
            ];
        } else {
            foreach ($users as $index => $user) {
                if (!isset($companies[$user->id])) {
                    unset($users[$index]);
                } else {
                    if (!in_array($company->name, $companies[$user->id])) {
                        unset($users[$index]);
                    }
                }
            }
            
            return [
                'users' => $users,
                'companies' => $companies,
                'logins' => $logins
            ];
        }
    }

    public function getEmployeeDetails(
        \stdClass $user,
        array $companies
    ): array
    {
        return [
            'user' => $user,
            'companies' => $this->userCompanyModel
                ->getUserCompany($user->id)
            ,
        ];
    }

    public function deactivateEmployee(int $userId): bool
    {
        return $this->userModel->deactivateUser($userId);
    }

    public function setEmployee(
        int $userId = null,
        array $data,
        array $companies
    ): int
    {
        $operation = $this->userModel->setUser(
            $userId,
            $data['user']
        );

        $this->userCompanyModel->setUserCompany(
            $operation->userId,
            $data['company'] ?? [],
            $companies
        );

        return $operation->userId;
    }
}
