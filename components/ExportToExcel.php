<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 13.01.2019
 * Time: 20:32
 */

namespace app\components;

use Yii;
use yii\base\Component;
use yii\web\NotFoundHttpException;

class ExportToExcel extends Component
{
    public function exportExcel($file, $fileName, $options)
    {
        if($file == NULL) {
            throw new NotFoundHttpException('No Data Available for Export to Excel');
        }

        Yii::$app->response->sendContentAsFile($file ,$fileName, $options);
        Yii::$app->end();
    }
}