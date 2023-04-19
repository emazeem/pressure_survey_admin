<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Models\Block;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    //
    use CommonTrait;
    public function block(Request $request){
        $validators = Validator($request->all(), [
            'auth_id' => 'required',
            'user_id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }

        $block = new Block();
        $block->from = $request->auth_id;
        $block->to = $request->user_id;
        $block->save();
        return $this->sendSuccess("User blocked successfully.",true);
    }

    public function fetch(Request $request)
    {
        $validators = Validator($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $block_user = Block::query()
            ->where('from', $request->user_id)->select('id', 'from', 'to')
            ->get();
        $blockedUsersIds = [];
        foreach ($block_user as $item) {
            $blockedUsersIds[] = $item->to;
        }
        $users = User::whereIn('id', $blockedUsersIds)->select('id', 'fname', 'lname', 'profile', 'email')->get();
        $data['users'] = $users;
        return $this->sendSuccess("User fetch successfully.", $data);
    }

    public function remove(Request $request){
        $validators = Validator($request->all(), [
            'user_id' => 'required',
            'auth_id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }

        Block::query()
            ->where('from', $request->auth_id)
            ->where('to', $request->user_id)
            ->delete();

        return $this->sendSuccess("User unblocked successfully.", true);

    }

}
