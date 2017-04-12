<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;


use backend\modules\articles\models\TbArticle;
use backend\modules\articles\models\TbArticleSearch;

use backend\modules\slide\models\TbSlide;
use backend\modules\slide\models\TbSlideSearch;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel=  new TbArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 6;
        $dataProvider->sort->defaultOrder = ['art_id'=>'DESC'];
        
        
        $tbSlide = new TbSlideSearch();
        $slide = $tbSlide->search(Yii::$app->request->queryParams);
        $slide->pagination->pageSize = 6;
        $slide->sort->defaultOrder = ['slide_sort'=>'DESC'];
        return $this->render('index',
        [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'slide' => $slide,
        ]);
    }

    public function actionLogin()
    {
       //$this->layout='login';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
