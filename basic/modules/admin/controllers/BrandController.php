<?php

namespace app\modules\admin\controllers;
use app\common\services\ConstantMapService;
use app\models\brand\BrandImages;
use app\models\brand\BrandSetting;
use app\modules\admin\controllers\base\BaseController;

use yii\web\Controller;


class BrandController extends BaseController
{
    //品牌详情
    public function actionInfo()
    {
        $info = BrandSetting::find()->one();
        return $this->render("info",['info' => $info]);

    }
    public function actionSet()
    {
        if(\Yii::$app->request->isGet){
            $info = BrandSetting::find()->one();
            return $this->render("set",['info' => $info]);
        }
        $date_now = date("Y-m-d H:i:s");
        $name = trim($this->post("name",""));
        $logo = trim($this->post("logo",""));
        $mobile = trim($this->post("mobile",""));
        $address = trim($this->post("address",""));
        $description = trim($this->post("description",""));
        if(mb_strlen($name,"utf-8")<1){
            return $this->renderJson([],"请输入符合规范的品牌名称!",-1);
        }

        if(mb_strlen($logo,"utf-8")<1){
            return $this->renderJson([],"请上传品牌Logo",-1);
        }

        if(mb_strlen($mobile,"utf-8")<1){
            return $this->renderJson([],"请输入符合规范的手机号码!",-1);
        }

        if(mb_strlen($address,"utf-8")<1){
            return $this->renderJson([],"请输入符合规范的地址!",-1);
        }

        if(mb_strlen($description,"utf-8")<1){
            return $this->renderJson([],"请输入符合规范的详情!",-1);
        }

        $info = BrandSetting::find()->one();
        if($info){
            $model_brand = $info;
        }else{
            $model_brand = new BrandSetting();
            $model_brand->created_time = $date_now;
        }
        $model_brand->name = $name;
        $model_brand->logo = $logo;
        $model_brand->mobile = $mobile;
        $model_brand->address = $address;
        $model_brand->description = $description;
        $model_brand->updated_time = $date_now;
        $model_brand->save(0);
        return $this->renderJson([],"操作成功");

    }
    public function actionImages()
    {
        $list = BrandImages::find()->orderBy(['id' => SORT_DESC])->all();
        return $this->render("images",[
           'list' => $list,
        ]);
    }
    public function actionSetImage()
    {
        $image_key = trim($this->post("image_key",""));
        if(!$image_key){
            return $this->renderJson([],"请上传图片后再提交!",-1);
        }
        $total_count = BrandImages::find()->count();
        if($total_count>=5){
            return $this->renderJson([],"最多上传5张图片",-1);
        }
        $model = new BrandImages();
        $model->image_key = $image_key;
        $model->created_time = date("Y-m-d H:i:s");
        $model->save(0);
        return $this->renderJson([],"操作成功!");
    }
    public function actionImageOps()
    {
        if(!\Yii::$app->request->isPost){
            return $this->renderJson([],ConstantMapService::$default_syserror,-1);
        }

        $id = $this->post('id',[]);
        if(!$id){
            return $this->renderJson([],"请选择要删除的图片!",-1);
        }
        $info = BrandImages::find()->where(['id'=>$id])->one();
        if(!$info){
            return $this->renderJson([],"指定图片不存在!",-1);
        }
        $info->delete();
        return $this->renderJson([],"操作成功!");

    }
}
