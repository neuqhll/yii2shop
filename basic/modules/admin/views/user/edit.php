<?php
use app\common\services\StaticService;
StaticService::includeAppJsStatic("/js/admin/user/edit.js",app\assets\AdminAsset::className());
?>

<?php echo \Yii::$app->view->renderFile("@app/modules/admin/views/common/tab_user.php",['current' => 'edit']);?>
<div class="row m-t  user_edit_wrap">
            <div class="col-lg-12">
                <h2 class="text-center">账号信息编辑</h2>
                <div class="form-horizontal m-t m-b">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">手机:</label>
                        <div class="col-lg-10">
                            <input type="text" name="mobile" class="form-control" placeholder="请输入手机~~"  value="<?=$user_info['mobile'];?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">姓名:</label>
                        <div class="col-lg-10">
                            <input type="text" name="nickname" class="form-control" placeholder="请输入姓名~~" value="<?=$user_info['nickname'];?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">邮箱:</label>
                        <div class="col-lg-10">
                            <input type="text" name="email" class="form-control" placeholder="请输入邮箱~~" value="<?=$user_info['email'];?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-2">
                            <button class="btn btn-w-m btn-outline btn-primary save">保存</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
