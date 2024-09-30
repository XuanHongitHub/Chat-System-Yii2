<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property int $chat_room_id
 * @property int $user_id
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ChatRooms $chatRoom
 * @property MessageStatus[] $messageStatuses
 * @property User $user
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chat_room_id', 'user_id', 'content', 'created_at', 'updated_at'], 'required'],
            [['chat_room_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['chat_room_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChatRooms::class, 'targetAttribute' => ['chat_room_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chat_room_id' => 'Chat Room ID',
            'user_id' => 'User ID',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[ChatRoom]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ChatRoomsQuery
     */
    public function getChatRoom()
    {
        return $this->hasOne(ChatRooms::class, ['id' => 'chat_room_id']);
    }

    /**
     * Gets query for [[MessageStatuses]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MessageStatusQuery
     */
    public function getMessageStatuses()
    {
        return $this->hasMany(MessageStatus::class, ['message_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\MessagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MessagesQuery(get_called_class());
    }
}
