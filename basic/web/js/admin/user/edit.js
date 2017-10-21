/**
 * Created by apple on 2017/9/13.
 */
;
var user_edit_ops ={
    init:function(){
        this.eventBind();
    },
    eventBind:function(){
        $(".save").click(function(){
            var btn_target = $(this);
            if(btn_target.hasClass("disabled")){
                alert("正在处理,请不要重复点击!");
                return false;
            }
            var mobile=$(".user_edit_wrap input[name = mobile]").val();
            var nickname=$(".user_edit_wrap input[name = nickname]").val();
            var email=$(".user_edit_wrap input[name = email]").val();
            var reg_mobile=new RegExp("^1\\d{10}$");
            var reg_email = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+\\.){1,63}[a-z0-9]+$");

            if(mobile.match(reg_mobile)==null){
                common_ops.tip("请输入正确的手机号,请重新输入!",$(".user_edit_wrap input[name = mobile]"));
                return false;
            }

            if(nickname.length<4)
            {
                common_ops.tip("姓名长度不能小于4,请重新输入!",$(".user_edit_wrap input[name = nickname]"));
                return false;
            }

            if(email.match(reg_email)==null){
                common_ops.tip("请输入正确的邮箱地址,请重新输入!",$(".user_edit_wrap input[name = email]"));
                return false;
            }

            btn_target.addClass("disabled");

            $.ajax({
               url:'/admin/user/edit',
                type:'POST',
                data:{
                    mobile:mobile,
                    nickname:nickname,
                    email:email
                },
                dataType:'json',
                success:function(res){
                    btn_target.removeClass("disabled");
                    alert(res.msg);
                    if(res.code == 200){
                        window.location.href = window.location.href;
                    }
                }
            });
        });
    }
};

$(document).ready(function(){
   user_edit_ops.init();
});
