<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\t_book;
use yii\web\Request;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        /** http://localhost:8080/index.php?r=site/index&id=1 **/
//        $request = \yii::$app->request;
//        $id = $request->get('id');
//        $sql = 'select * from t_book where id=:id';
//        $data = t_book::findBySql($sql, [':id' => $id])->all();

        /**获取所有数据**/
        $data = t_book::find()->all();

        /**查询单条数据**/
//        $data = t_book::find()->where(['id' => 1])->all();

        /**插入数据**/
//        $t_book = new t_book();
//        $t_book->name = '怪物少女妮莫娜';
//        $t_book->author = '诺埃尔·史蒂文森';
//        $t_book->desc = '妮莫娜是一个虎头虎脑的小姑娘；她跟别的小姑娘不一样的地方是她会七十二变。';
//        $t_book->insert();
//        $t_book->save();

        /**修改某条数据**/
//        $t_book = t_book::findOne(6);
//        $t_book->desc = '这条数据被修改过！';
//        $t_book->update();
//        $t_book->save();

        /*删除某条记录*/
//        $t_book = t_book::findOne(9);
//        $t_book->delete();
        /*删除多条件记录*/
//        $t_book = t_book::deleteAll('id>:id And num<:num', [':id' => 13, ':num' => 100]);

        /*实例化表单模型*/
        $request = new Request();
        $model = new t_book();

        if ($request->isPost) {//$_SERVER['REQUEST_METHOD'] == 'POST'
            $searchId = $request->post('id');
            var_dump($searchId);
            die;
            //接收表单
            $model->load($request->post());// $model->name = $_POST['name']
            //校验规则
            $result = $model->validate();
            if ($result) {
                //保存到数据库
                $model->save();
                \yii::$app->session->setFlash('success', '添加成功！');
                $this->refresh();
            } else {
                var_dump($model->getErrors());
            }
        }

        $id = $request->get('id');
        $action = $request->get('action');
        if ($action == 'delete') {
            $t_book = t_book::findOne($id);
            $t_book->delete();
            return $this->redirect(['/']);
        }

        return $this->render('index', ['data' => $data, 'model' => $model]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
