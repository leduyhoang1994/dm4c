<?php

namespace app\controllers;

use Yii;

/**
 * interface dùng cho 4 chiều danh mục
 *
 * Interface Dm4cController
 * @package app\controllers
 */
interface Dm4cController
{
    /**
     * Action tìm kiếm
     * @return mixed
     */
    public function actionSearch();

    /**
     * Action thể hiện dữ liệu dưới dạng cây, hiện tại đang tạm thời không sử dụng
     * @return mixed
     */
    public function actionNested();
}