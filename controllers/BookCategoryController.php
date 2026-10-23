<?php

namespace app\controllers;

use Yii;
use app\models\BookCategory;
use app\models\BookCategorySearch;
use yii\db\IntegrityException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * CRUD Thể loại sách.
 *  - Người dùng đã đăng nhập (admin và user): xem danh sách, xem chi tiết.
 *  - Chỉ admin: thêm, sửa, xóa.
 */
class BookCategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    // Mọi tài khoản đã đăng nhập được xem
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['@'],
                    ],
                    // Chỉ admin được thêm / sửa / xóa
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete'],
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return Yii::$app->user->identity->isAdmin();
                        },
                    ],
                ],
                'denyCallback' => function () {
                    if (Yii::$app->user->isGuest) {
                        // Chưa đăng nhập -> chuyển tới trang đăng nhập
                        Yii::$app->user->loginRequired();
                        return;
                    }
                    throw new ForbiddenHttpException(
                        'Truy cập bị từ chối: chỉ quản trị viên (admin) mới được thêm, sửa hoặc xóa thể loại sách.'
                    );
                },
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => ['delete' => ['post']],
            ],
        ];
    }

    /** Danh sách + tìm kiếm + phân trang. */
    public function actionIndex()
    {
        $searchModel = new BookCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /** Xem chi tiết một thể loại. */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /** Thêm mới. */
    public function actionCreate()
    {
        $model = new BookCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Đã thêm thể loại sách "' . $model->category_name . '".');
            return $this->redirect(['view', 'id' => $model->category_code]);
        }

        return $this->render('create', ['model' => $model]);
    }

    /** Cập nhật (không cho đổi mã thể loại). */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = BookCategory::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Đã cập nhật thể loại sách "' . $model->category_name . '".');
            return $this->redirect(['view', 'id' => $model->category_code]);
        }

        return $this->render('update', ['model' => $model]);
    }

    /** Xóa (chỉ nhận phương thức POST). */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $name = $model->category_name;

        try {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Đã xóa thể loại sách "' . $name . '".');
        } catch (IntegrityException $e) {
            // Xảy ra khi thể loại đang được bảng khác (ví dụ: sách) tham chiếu tới
            Yii::$app->session->setFlash('danger', 'Không thể xóa thể loại "' . $name . '" vì đang có dữ liệu liên quan.');
        }

        return $this->redirect(['index']);
    }

    /**
     * @param string $id Mã thể loại
     * @return BookCategory
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = BookCategory::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Không tìm thấy thể loại sách được yêu cầu.');
    }
}
