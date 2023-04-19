<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Models\Block;
use App\Models\Chat;
use App\Models\Report;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserDevices;
use App\Models\UserReport;
use carbon\carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    use CommonTrait;
    public function all_users(Request $request)
    {
        $user = User::Query()->select('id', 'fname', 'lname', 'username', 'email', 'profile', 'phone', )->get();
        if ($user) {
            $data['all-users'] = $user;
            return $this->sendSuccess("User Data", $data);
        } else {
            return $this->sendError("No user found", null);
        }
    }
    public function fetch(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $blockedUsersId = [];
        foreach (Block::where('from', \auth()->user()->id)->orwhere('to', \auth()->user()->id)->get() as $blockUser) {
            if ($blockUser->from == auth()->user()->id) {
                $blockedUsersId[] = $blockUser->to;
            }
            if ($blockUser->to == auth()->user()->id) {
                $blockedUsersId[] = $blockUser->from;
            }
        }
        $user = User::Query()->select('id', 'fname', 'lname', 'username', 'email', 'country_code', 'phone', 'email_verified_at', 'gender', 'role', 'email_code', 'profile', 'created_at')->whereNotIn('id', $blockedUsersId)->find($request->id);
        if ($user) {
            $user['unread_messages'] = Chat::select('to', 'read_at')->where('to', $user->id)->whereNull('read_at')->get()->count();
            $unreadNotifications = (int) count($user->unreadNotifications);
            $user['unread_notification'] = $unreadNotifications;
            $data['user_data'] = $user;
            $data['is_block'] = isUserBlocked($user->id);
            return $this->sendSuccess("User Data", $data);
        } else {
            return $this->sendError("No user found", null);
        }
    }
    public function details(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $ambassador_details = UserDetail::with('speciality')->where('user_id', $request->id)->first();
        $data['ambassador_details'] = $ambassador_details;
        return $this->sendSuccess("Ambassador Details..", $data);

    }
    public function update_password(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
            'current_password' => 'required|min:8',
            'new_password' => 'required|same:confirm_password|min:8',

        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $user = User::find($request->id);
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            $data['action'] = true;
            return $this->sendSuccess("Password updated successfully!", $data);
        } else {
            return $this->sendError("Incorrect current password!", null);
        }
    }

    public function create_new_password(Request $request)
    {
        $validators = Validator($request->all(), [
            'otp' => 'required',
            'email' => 'required',
            'new_password' => 'min:8|required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $user = User::where('email', $request->email)->first();
        if ($user->email_token == $request->otp) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            $data['success'] = true;
            return $this->sendSuccess("Password updated successfully!", $data);
        } else {
            $data['success'] = false;
            return $this->sendError("Incorrect OTP!", null);
        }
    }

    public function search(Request $request)
    {
        $validators = Validator($request->all(), [
            'search' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $search = $request['search'] ? $request['search'] : "";

        $blockedUsersId = allBlockList();

        $user = User::where('id', '!=', auth()->user()->id)->whereNotIn('id', $blockedUsersId)->where('role', 3)
            ->whereRaw('( email LIKE "%' . $search . '%" or fname LIKE "%' . $search . '%" or lname LIKE "%' . $search . '%" or concat(fname," ",lname) LIKE "%' . $search . '%" )')->get();
        $data['user_detail'] = $user;
        return $this->sendSuccess("User Details..", $data);
    }
    public function Update_profile(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $user = User::find($request->id);
        if ($request->fname) {$user->fname = $request->fname;}
        if ($request->lname) {$user->lname = $request->lname;}
        if ($request->phone) {$user->phone = $request->phone;}
        $user->save();

        $user_detail = UserDetail::where('user_id', $request->id)->first();

        if ($request->fax) {$user_detail->fax = $request->fax;}
        if ($request->about) {$user_detail->about = $request->about;}
        if ($request->high_school) {$user_detail->high_school = $request->high_school;}
        if ($request->hobbies) {$user_detail->hobbies = $request->hobbies;}

        if ($request->longitude) {$user_detail->longitude = $request->longitude;}
        if ($request->latitude) {$user_detail->latitude = $request->latitude;}

        if ($request->city) {$user_detail->city = $request->city;}
        if ($request->state) {$user_detail->state = $request->state;}
        if ($request->country) {$user_detail->country = $request->country;}
        if ($request->address) {$user_detail->address = $request->address;}

        if ($request->workplace) {$user_detail->workplace = $request->workplace;}
        if ($request->workplace_longitude) {$user_detail->workplace_longitude = $request->workplace_longitude;}
        if ($request->workplace_latitude) {$user_detail->workplace_latitude = $request->workplace_latitude;}

        $user_detail->save();

        $data['user_detail'] = $user_detail;
        return $this->sendSuccess("Social information updated", $data);
    }
    public function Chats(Request $request)
    {
        $validators = Validator($request->all(), [
            'user' => 'required',
            'id' => 'required',
            'key' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $chats = Chat::select('id', 'from', 'to', 'message', 'created_at', 'file')
            ->where('to', $request->user)->where('from', $request->id)->where('type', $request->key)
            ->orwhere('from', $request->user)->where('to', $request->id)->where('type', $request->key)
            ->get();

        $response['allow'] = BlockGate($request->user);
        $response['messages'] = $chats;
        //$blockedByMe=Block::where('from',$request->id)->where('to',$request->user)->first();
        $response['auth_user'] = User::select(['id', 'fname', 'lname', 'email', 'phone', 'profile'])->where('id', $request->id)->first();
        $response['other_user'] = User::select(['id', 'fname', 'lname', 'email', 'phone', 'profile'])->where('id', $request->user)->first();
        return $this->sendSuccess("Message fetch successfully..", $response);
    }
    public function Store_Chat(Request $request)
    {
        $validators = Validator($request->all(), [
            'user' => 'required',
            'id' => 'required',
            'key' => 'required',
            'message' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $chat = new Chat;
        $chat->from = $request->id;
        $chat->to = $request->user;
        $chat->message = $request->message;
        $chat->type = $request->key;
        $file = null;
        if ($request->file) {
            $attachment = time() . $request->file->getClientOriginalName();
            Storage::disk('local')->put('/public/chat/' . auth()->user()->id . '/' . $attachment, File::get($request->file));
            $chat->file = $attachment;
            $file = Storage::disk('local')->url('/chat/' . auth()->user()->id . '/' . $attachment);
        }
        $chat->save();
        a_notification($request->user, '<b>' . auth()->user()->fullName() . '</b> sent you a message.', ['url' => 'chat', 'data' => (int) $request->id]);
        $response['message'] = $chat;
        return $this->sendSuccess("Message sent successfully..", $response);
    }
    public function change_profile_photo(Request $request)
    {
        $validators = Validator($request->all(), [
        'profile' => 'required|image|mimes:png,jpeg,jpg',
        'id' => 'required',
        ]);
        if ($validators->fails()) {
        return $this->sendError($validators->messages()->first(), null);
        }
            $user = User::find($request->id);

            // $image = $request->file('profile');

            // $image_name = time() . '.' . $image->getClientOriginalExtension();

            // $path = 'storage/profile/' . $user->email . '/';
            // if (!File::exists($path)) {
            //     File::makeDirectory($path, $mode = 0755, true, true);
            // }

            // $path = 'storage/profile/' . $user->email . '/' . $image_name;

            // Image::make($image->getRealPath())->resize(300, 200)->save($path);

            $attachment = imageResize($request['profile'], 'storage' . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR . $user->email . DIRECTORY_SEPARATOR);
            profileResize($request['profile'], 'storage' . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR . $user->email . DIRECTORY_SEPARATOR, $attachment, 100);
            $user->profile = $attachment;
            
            $user->save();

            //$user->profilePicturePost($attachment, $request['profile']);
       
        $response['success'] = true;

        return $this->sendSuccess("Profile updated successfully!", $response);

    }
    public function change_cover_photo(Request $request)
    {
        $validators = Validator($request->all(), [
            'cover' => 'required',
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }

        $user = User::find($request->id);
        $attachment = imageResize($request['cover'], 'storage/a/covers/' . $user->id . '/');
        $detail = UserDetail::find($user->details->id);

        $detail->cover_photo = $attachment;
        $detail->save();
        $user->profileCoverPost($attachment, $request['cover']);
        $response['success'] = true;

        return $this->sendSuccess("Cover updated successfully!", $response);

    }

    public function forgot_password_email(Request $request)
    {

        $validators = Validator($request->all(), [
            'email' => 'required|email|max:50',
        ]);

        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $rand = rand(100000, 999999);
            $user->email_token = $rand;
            $user->save();
            $message = 'Hello ' . $user->fullName() . ',<br>
            You recently requested for a password reset for your NP Social account. OTP to reset to your password is ' . $rand . '.<br>
            We recommend setting a unique password that you don’t use for other sites. For any further assistance, do not hesitate to contact us at abc@gmail.com.<br>Thanks<br>NP Social';
            sendEmail($request->email, null, 'Password Reset Link', $message);
        }
        $res['success'] = true;
        $response = 'If the email entered is associated with a NP Social account, you will receive an email with password reset instructions.';
        return $this->sendSuccess($response, $res);
    }

    public function Update_user(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'username' => 'required',
            'phone' => 'required',
            'npi' => 'required',

        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $user = User::find($request->id);
        $user->gender = $request->gender;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->save();
        $user_detail = UserDetail::where('user_id', $request->id)->first();
        $user_detail->date_of_birth = $request->dob;
        $user_detail->npi = $request->npi;
        $user_detail->kyc_status = 1;
        $user_detail->kyc_reject_reason = null;

        $user_detail->save();
        $data['user'] = $user;
        $data['user_detail'] = $user_detail;
        return $this->sendSuccess("Your request is submitted successfully!", $data);
    }

    public function store_device(Request $request)
    {
        $validators = Validator($request->all(), [
            'user_id' => 'required',
            'device_id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $device = UserDevices::where('device_id', $request->device_id)->first();
        if ($device) {
            return $this->sendError('Not add the device because this device can be exist', null);
        } else {
            $user_device = new UserDevices;
            $user_device->user_id = $request->user_id;
            $user_device->device_id = $request->device_id;
            $user_device->save();
            $data['user_device'] = $user_device;
            return $this->sendSuccess("Device added successfully!", $data);
        }
    }

    public function Read_at(Request $request)
    {
        $validators = Validator($request->all(), [
            'from' => 'required',
            'to' => 'required',
            'key' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $chats = Chat::where('from', $request->from)->where('to', $request->to)->where('type', $request->key)->get();
        foreach ($chats as $chat) {
            $chat->read_at = Carbon::now();
            $chat->save();
        }
        $response['messages'] = true;
        return $this->sendSuccess("Messages read successfully..", $response);
    }

    public function remove_device(Request $request)
    {
        $validators = Validator($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $devices = UserDevices::where('user_id', $request->user_id)->get();
        foreach ($devices as $device) {
            $device->delete();
        }
        $response['remove_devices'] = true;
        return $this->sendSuccess("Devices deleted successfully", $response);

    }
    public function delete_account(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $user = User::find($request->id);
        if ($user) {
            $user->comment()->delete();
            $user->like()->delete();
            $user->user_detail()->delete();
            $user->userdevices()->delete();
            foreach ($user->post as $post) {
                $post->assets()->delete();
            }
            $user->post()->delete();
            $user->report()->delete();
            $user->chat_receiver()->delete();
            $user->chat_sender()->delete();
            $user->friend_to()->delete();
            $user->friend_from()->delete();
            $user->block_to()->delete();
            $user->block_from()->delete();
            $user->delete();
            $data['user'] = $user;
            return $this->sendSuccess("Account deleted Successfully", $data);
        } else {
            return $this->sendError("Account not deleted", null);
        }

    }

    public function report_user(Request $request)
    {
        try {
            $validators = Validator($request->all(), [
                'userId' => 'required',
                'authId' => 'required',
                'description' => 'required',
            ]);
            if ($validators->fails()) {
                return $this->sendError($validators->messages()->first(), null);
            }
            $report = new UserReport();
            $report->to = $request->userId;
            $report->from = $request->authId;
            $report->description = $request->description;
            $report->save();

            return $this->sendSuccess("User reported successfully", true);

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), null);

        }

    }

    public function update_location(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $user = UserDetail::where('user_id', $request->id)->first();

        $user->save();
        return $this->sendSuccess("Information updated successfully", true);
    }
    public function fetch_long_lat(Request $request)
    {
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }

        $details = UserDetail::whereNotNull('workplace_longitude')->select('id', 'user_id', 'workplace_longitude', 'workplace_latitude', 'workplace')->with('user', function ($q) {
            $q->select('id', 'fname', 'lname', 'email', 'phone', 'profile')->get();
        })->get();

        $data = [];
        foreach ($details as $detail) {
            $data[] = $detail;
        }
        return $this->sendSuccess("Users with location fetched successfully", $data);
    }

}
