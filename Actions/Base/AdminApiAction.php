<?php


namespace App\Actions\Base;


use App\Lib\Slime\Exceptions\Http\UnAuthorizedException;
use App\Models\Users\Admin;

abstract class AdminApiAction extends AuthApiAction
{

    protected function performChecks()
    {
        parent::performChecks();
        $admin = Admin::where('user_id', $this->userId)->first();
        $this->userId = empty($admin) ? null : $admin->user_id;
        if (empty($this->userId)) {
            // Log attempt of normal user to do admin action
            throw new UnAuthorizedException('Unauthorized');
        }
    }

    protected function performCallBack()
    {
        //Audit Admin Action?
    }

}