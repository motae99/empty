<?php
namespace api\common\controllers;
use \Yii as Yii;
use api\models\User;
use api\common\models\Task;
use yii\filters\auth\QueryParamAuth;
use yii\db\Expression;


class TaskController extends \api\components\ActiveController
{
    public $modelClass = '\api\common\models\Task';

    public function accessRules()
    {
        return [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
            [
                'allow' => true,
                'actions' => [
                    'view',
                    'index',
                    'update',
                ],
                'roles' => ['@'],
            ],
            [
                'allow' => true,
                'actions' => ['create', 'delete'],
                'roles' => ['@'],
                'scopes' => ['admin'],
            ],
            [
                'allow' => true,
                'actions' => ['protected'],
                'roles' => ['@'],
                'scopes' => ['admin'],
            ]
        ];
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['create']);
        unset($actions['update']);
        return $actions;
    }

    public function actionIndex(){
        $query_param_auth = QueryParamAuth::className();
        $tokenParam = 'access_token';
        $user = User::findIdentityByAccessToken($tokenParam);
        $data = Task::find()->where(['created_by' => $user->id])->orWhere(['assigned_to' => $user->id])->all();
        // ->select(['id', 'name', 'description', 'due_date'])
        return $data;

    }

    public function actionUpdate($id){
        $model = Task::findOne($id);
        $query_param_auth = QueryParamAuth::className();
        $tokenParam = 'access_token';
        $user = User::findIdentityByAccessToken($tokenParam);
        if($model->assigned_to === $user->id){
            $model->submitted_at = new Expression('NOW()');
            if ($model->save()) {
                return array('success' => 1);
            }else{
                return array('success' => 0);
            }
        }


    }


    public function actionCreate(){
        $model = new Task();
        $body = json_decode(Yii::$app->getRequest()->getRawBody(), true);
        $model->load($body, '');
        $model->name = $body['name'];
        $model->description = $body['description'];
        $model->due_date = $body['due_date'];
        $model->assigned_to = $body['assigned_to'];
        $model->created_by = 1;
        $model->created_at = new Expression('NOW()');
        if ($model->save()) {
            return array('success' => 1);
        }else{
            return array('success' => 0);
        }

        // echo $body['due_date'];
        // print_r($body);

        
    }


    public function actionProtected()
    {
        return ['status' => 'ok', 'underScope' => 'protected'];
    }
}