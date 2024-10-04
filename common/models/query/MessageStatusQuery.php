<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\MessageStatus]].
 *
 * @see \common\models\MessageStatus
 */
class MessageStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\MessageStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\MessageStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
