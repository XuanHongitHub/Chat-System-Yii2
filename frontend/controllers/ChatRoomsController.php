<?php

namespace frontend\controllers;

use common\models\ChatRooms;
use common\models\ChatRoomUser;
use app\models\ChatRooms as ChatRoomsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;

/**
 * ChatRoomsController implements the CRUD actions for ChatRooms model.
 */
class ChatRoomsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionJoin($chatRoomId)
    {
        $chatRoomUser = new ChatRoomUser();
        $chatRoomUser->user_id = Yii::$app->user->id; // Lấy ID người dùng hiện tại
        $chatRoomUser->chat_room_id = $chatRoomId; // Lấy ID phòng chat

        if ($chatRoomUser->save()) {
            Yii::$app->session->setFlash('success', 'Bạn đã tham gia phòng chat thành công.');
            return $this->redirect(['chat-room/view', 'id' => $chatRoomId]); // Chuyển hướng đến trang xem phòng chat
        } else {
            Yii::$app->session->setFlash('error', 'Có lỗi xảy ra khi tham gia phòng chat.');
            return $this->redirect(['index']); // Quay lại danh sách phòng chat nếu có lỗi
        }
    }
    /**
     * Lists all ChatRooms models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ChatRoomsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ChatRooms model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionViewChat($id)
    {
        $model = ChatRooms::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }


    /**
     * Creates a new ChatRooms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ChatRooms();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ChatRooms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ChatRooms model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ChatRooms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ChatRooms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ChatRooms::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
