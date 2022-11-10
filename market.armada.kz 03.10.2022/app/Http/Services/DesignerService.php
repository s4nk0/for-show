<?php

namespace App\Http\Services;

use App\Models\DesignerInfo;
use App\Models\DesignerProject;
use App\Models\User;
use App\Models\UserRole;

class DesignerService
{
    public function getDesignerUser($id){
        $user = User::find($id);
        $userInfo = DesignerInfo::where('user_id','=',$id)->first();
        $user->years = $userInfo->years ?? '';
        $user->description = $userInfo->description ?? '';
        $user->designerStyles = $userInfo->designerStyles ?? collect();

        return $user;
    }

    public function deleteDesignerProject($id){
        $id = explode(',', $id);

        if(!is_array($id))
        {
            $id[] = $id;
        }

        foreach ($id as $item)
        {
            $data = DesignerProject::find($item);
            $data->delete();
        }

        return $id;

    }
}
