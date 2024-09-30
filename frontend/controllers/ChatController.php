<?php

namespace frontend\controllers;

use common\models\User;
use common\models\Contacts;
use common\models\Messages;
use yii\web\Response;
use yii\web\Controller;
use common\models\ChatRooms;
use common\models\ChatRoomUser;
use app\models\ChatRooms as ChatRoomsSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;

class ChatController extends Controller
{
    public function actionGetContacts()
    {
        $userId = Yii::$app->user->id; // Lấy ID của người dùng đang đăng nhập
        $contacts = Contacts::find()->where(['user_id' => $userId])->with('contactUser')->all();

        $contactData = [];
        foreach ($contacts as $contact) {
            $contactUser = User::findOne($contact->contact_user_id);
            if ($contactUser) {
                $contactData[] = [
                    'id' => $contactUser->id, // Lấy ID người dùng
                    'username' => $contactUser->username // Lấy tên người dùng
                ];
            }
        }

        return $this->asJson($contactData); // Trả về danh sách contact
    }


    public function actionAddContact()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $username = Yii::$app->request->post('username');
        if ($username) {
            // Kiểm tra xem user có tồn tại không
            $user = User::find()->where(['username' => $username])->one();
            if ($user) {
                $contact = new Contacts();
                $contact->user_id = Yii::$app->user->id; // User hiện tại
                $contact->contact_user_id = $user->id; // User được thêm
                $contact->created_at = time(); // Thời gian tạo
                $contact->updated_at = time(); // Thời gian cập nhật

                if ($contact->save()) {
                    return ['status' => 'success', 'message' => 'Liên hệ đã được thêm!'];
                }
            } else {
                return ['status' => 'error', 'message' => 'User không tồn tại!'];
            }
        }
        return ['status' => 'error', 'message' => 'Tên tài khoản không hợp lệ.'];
    }
    // public function actionAddRoom()
    // {
    //     Yii::$app->response->format = Response::FORMAT_JSON;

    //     $roomName = Yii::$app->request->post('room_name'); // Tên phòng chat
    //     $members = Yii::$app->request->post('members'); // Danh sách ID thành viên, có thể là array

    //     if ($roomName) {
    //         // Tạo một phòng chat mới
    //         $chatRoom = new ChatRooms();
    //         $chatRoom->name = $roomName; // Tên phòng
    //         $chatRoom->visibility = false; // Thiết lập visibility mặc định (có thể thay đổi tùy theo logic của bạn)
    //         $chatRoom->created_by = Yii::$app->user->id; // ID người tạo
    //         $chatRoom->created_at = time(); // Thời gian tạo
    //         $chatRoom->updated_at = time(); // Thời gian cập nhật

    //         // Kiểm tra và lưu phòng chat
    //         if ($chatRoom->save()) {
    //             // Nếu có danh sách thành viên, thêm họ vào phòng chat
    //             if (!empty($members)) {
    //                 foreach ($members as $memberId) {
    //                     // Thêm thành viên vào bảng chat_room_user
    //                     $chatRoomUser = new ChatRoomUser(); // Tạo model cho bảng chat_room_user
    //                     $chatRoomUser->chat_room_id = $chatRoom->id; // ID phòng chat
    //                     $chatRoomUser->user_id = $memberId; // ID người dùng
    //                     $chatRoomUser->joined_at = time(); // Thời gian tham gia
    //                     $chatRoomUser->save(); // Lưu thành viên vào phòng
    //                 }
    //             }
    //             return ['status' => 'success', 'message' => 'Phòng chat đã được thêm!'];
    //         } else {
    //             return ['status' => 'error', 'message' => 'Có lỗi xảy ra khi thêm phòng chat.'];
    //         }
    //     }
    //     return ['status' => 'error', 'message' => 'Tên phòng không hợp lệ.'];
    // }
    public function actionAddRoom()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $roomName = Yii::$app->request->post('room_name');
        $members = Yii::$app->request->post('members'); // Lấy danh sách thành viên từ POST

        if (empty($roomName) || empty($members)) {
            return [
                'status' => 'error',
                'message' => 'Tên phòng và thành viên không được để trống.'
            ];
        }

        // Chuyển đổi chuỗi JSON thành mảng
        $memberIds = [];
        foreach (json_decode($members) as $member) {
            $memberIds[] = $member->id; // Lấy ID từ đối tượng
        }

        // Thực hiện thêm phòng chat vào cơ sở dữ liệu
        $chatRoom = new ChatRooms();
        $chatRoom->name = $roomName;

        if ($chatRoom->save()) {
            // Lưu ID thành viên vào bảng liên kết chat_room_user
            foreach ($memberIds as $memberId) {
                $chatRoomUser = new ChatRoomUser();
                $chatRoomUser->chat_room_id = $chatRoom->id; // Gán ID phòng chat
                $chatRoomUser->user_id = $memberId; // Gán ID thành viên

                // Thêm thời gian tham gia (nếu cần)
                $chatRoomUser->joined_at = time(); // Hoặc sử dụng một giá trị thời gian khác

                if (!$chatRoomUser->save()) {
                    // Nếu không lưu được thành viên, bỏ qua và tiếp tục với các thành viên khác
                    Yii::error('Lỗi khi lưu thành viên: ' . implode(', ', $chatRoomUser->getFirstErrors()));
                }
            }

            return [
                'status' => 'success',
                'message' => 'Phòng chat đã được tạo thành công!'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Có lỗi xảy ra khi tạo phòng chat: ' . implode(', ', $chatRoom->getFirstErrors())
            ];
        }
    }



    public function actionSendMessage()
    {
        $model = new Messages();
        $model->load(Yii::$app->request->post());
        $model->user_id = Yii::$app->user->id; // ID của người dùng đang đăng nhập
        $model->created_at = time();
        $model->updated_at = time();

        if ($model->save()) {
            return $this->asJson(['success' => true, 'message' => $model]);
        }

        return $this->asJson(['success' => false]);
    }

    public function actionGetMessages($chatRoomId)
    {
        $messages = Messages::find()->where(['chat_room_id' => $chatRoomId])->all();
        return $this->asJson($messages);
    }

    public function actionJoinRoom($id)
    {
        $chatRoom = $this->findChatRoom($id);

        if ($chatRoom) {
            $chatRoomUser = new ChatRoomUser();
            $chatRoomUser->user_id = Yii::$app->user->id;
            $chatRoomUser->chat_room_id = $chatRoom->id;
            $chatRoomUser->joined_at = time();
            $chatRoomUser->save();

            return $this->redirect(['view', 'id' => $chatRoom->id]);
        }

        throw new NotFoundHttpException('Room not found.');
    }

    protected function findChatRoom($id)
    {
        if (($model = ChatRooms::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
