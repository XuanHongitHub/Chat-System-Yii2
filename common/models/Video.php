<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property int $id
 * @property string $video_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $tags
 * @property int|null $status
 * @property string|null $has_thumbnail
 * @property int|null $view_count
 * @property int|null $like_count
 * @property int|null $comment_count
 * @property string|null $video_path
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 */
class Video extends \yii\db\ActiveRecord
{
    public $video;
    public $thumbnail;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['video_id'], 'required'],
            [['description'], 'string'],
            [['status', 'view_count', 'like_count', 'comment_count', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['video_id'], 'string', 'max' => 16],
            [['title', 'tags', 'has_thumbnail', 'video_path'], 'string', 'max' => 512],
            [['video'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp4,mov,avi'],
            [['thumbnail'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'video_id' => 'Video ID',
            'title' => 'Title',
            'description' => 'Description',
            'tags' => 'Tags',
            'status' => 'Status',
            'has_thumbnail' => 'Has Thumbnail',
            'view_count' => 'View Count',
            'like_count' => 'Like Count',
            'comment_count' => 'Comment Count',
            'video_path' => 'Video Path',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VideoQuery(get_called_class());
    }

    public function getVideoLink()
    {
        return Yii::$app->params['backendUrl'] . 'uploads/videos/' . $this->video_path;
    }
}
