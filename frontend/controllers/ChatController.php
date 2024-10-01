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
    public function actionAddRoom()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $roomName = Yii::$app->request->post('room_name');
        $members = json_decode(Yii::$app->request->post('members'), true);

        if (empty($roomName)) {
            Yii::error('Tên phòng không hợp lệ.', __METHOD__);
            return ['status' => 'error', 'message' => 'Tên phòng không hợp lệ.'];
        }

        $chatRoom = new ChatRooms();
        $chatRoom->name = $roomName;
        $chatRoom->visibility = Yii::$app->request->post('visibility', false);
        $chatRoom->created_by = Yii::$app->user->id;
        $chatRoom->created_at = time();
        $chatRoom->updated_at = time();

        if ($chatRoom->save()) {
            $creatorChatRoomUser = new ChatRoomUser();
            $creatorChatRoomUser->chat_room_id = $chatRoom->id;
            $creatorChatRoomUser->user_id = Yii::$app->user->id;
            $creatorChatRoomUser->joined_at = time();

            if (!$creatorChatRoomUser->save()) {
                Yii::error('Failed to save creator to chat room user: ' . json_encode($creatorChatRoomUser->getErrors()), __METHOD__);
            } else {
                Yii::info('Creator ID: ' . Yii::$app->user->id . ' added successfully to chat room ID: ' . $chatRoom->id, __METHOD__);
            }

            if (!empty($members) && is_array($members)) {
                foreach ($members as $member) {
                    if (isset($member['id']) && is_int($member['id'])) {
                        $chatRoomUser = new ChatRoomUser();
                        $chatRoomUser->chat_room_id = $chatRoom->id;
                        $chatRoomUser->user_id = (int)$member['id'];
                        $chatRoomUser->joined_at = time();

                        if (!$chatRoomUser->save()) {
                            Yii::error('Failed to save chat room user: ' . json_encode($chatRoomUser->getErrors()), __METHOD__);
                        } else {
                            Yii::info('Member ID: ' . $member['id'] . ' added successfully to chat room ID: ' . $chatRoom->id, __METHOD__);
                        }
                    } else {
                        Yii::error('Invalid member data: ' . json_encode($member), __METHOD__);
                    }
                }
            } else {
                Yii::info('No members to add for chat room ID: ' . $chatRoom->id, __METHOD__);
            }

            return ['status' => 'success', 'message' => 'Phòng chat đã được thêm!'];
        } else {
            Yii::error('Failed to save chat room: ' . json_encode($chatRoom->getErrors()), __METHOD__);
            return ['status' => 'error', 'message' => 'Có lỗi xảy ra khi thêm phòng chat.'];
        }
    }


    public function actionSendMessage()
    {
        $model = new Messages();
        $model->load(Yii::$app->request->post());
        $model->user_id = Yii::$app->user->id;
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
