<?php

namespace frontend\controllers;

use yii;
use yii\web\Controller;
use frontend\models\Csvfile;
use yii\web\UploadedFile;
use frontend\component\insert;
use yii\helpers\FileHelper;

class FileController extends Controller
{

    
    function actionImport()
    {
        $model = new Csvfile();
        if ($model->load(Yii::$app->request->post())) {

            $file = UploadedFile::getInstance($model, 'file');
            $filename = time() . '.' . $file->extension;
            $upload = $file->saveAs('@homeroot/' . $filename);
            $result = [];
            if ($upload) {
                $path = Yii::getAlias("@homeroot");
                Insert::createdir($path);
                $fileHandler = fopen("$path/$filename", 'r');
                while ($filecsv = fgetcsv($fileHandler, 1000, ',')) {
                    $num = count($filecsv);
                    array_push($result, $filecsv);
                }
                $header = array_shift($result);
                $result2 = [];
                foreach ($result as $key => $value) {
                    $r2 = array_combine($header, $value);
                    array_push($result2, $r2);
                }
                if ($num == 2) {
                    $c1 = count($result2);
                    for ($i = 0; $i < $c1; $i++) {
                        $name = $result2[$i]['Name'];
                        $mobile = $result2[$i]['Mobile'];
                        $q = "INSERT INTO `dommy`(`name`, `mobile`) VALUES ('$name','$mobile')";
                        Insert::insert($q);
                    }
                } else {
                    $c1 = count($result2);
                    $data = insert::getdata();
                    echo "<pre>";
                    $n = count($data);
                    for ($i = 0; $i < $c1; $i++) {
                        $id = $result2[$i]['id'];
                        $name = $result2[$i]['name'];
                        $mob = $result2[$i]['mobile'];
                        $ckid = Insert::getId();
                        $arr = array_column($ckid, 'id');

                        if (in_array($id, $arr)) {
                            $q1 = "UPDATE `dommy` SET `name`='$name',`mobile`='$mob' WHERE `id`='$id'";
                            Insert::insert($q1);
                        } else {
                            echo "Match not found" . "<br>";
                            $q2 = "INSERT INTO `dommy`(`id`, `name`, `mobile`) VALUES ('$id','$name','$mob')";
                            Insert::insert($q2);
                        }
                    }
                }
            }
            $this->redirect(['import']);
        } else {
            return $this->render('import', ['model' => $model]);
        }
    }

    function actionExport()
    {

        $data = insert::getdata();
        // echo "<pre>";
        $n = count($data);

        for ($i = 0; $i < $n; $i++) {
            // $str = implode(" ", $data[$i]);
            $id = $data[$i]['id'];
            $name = $data[$i]['name'];
            $mobile = $data[$i]['mobile'];
            $path = Yii::getAlias("@homeroot");

            if (!file_exists("$path/data.csv")) {
                $file_handle = fopen("$path/data.csv", 'w');
                fputcsv($file_handle, array('id', 'name', 'mobile'));
                $i--;
            } else {
                $file_handle = fopen("$path/data.csv", 'a+');
                // fputcsv($file_handle, array('id','name','mobile'));
                fputcsv($file_handle, array($id, $name, $mobile));
                fclose($file_handle);
            }
        }

        if (file_exists("$path/data.csv")) {

            Yii::$app->response->sendFile("$path/data.csv")->send();
            unlink("$path/data.csv");
        }
        $this->redirect(['import']);
    }

}
