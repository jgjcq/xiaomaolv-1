$(function(){
  login();
  formEnterEvent();
});


//login按钮单击登录函数
function login(){
  $('#login').click(function(){
    $.post("Admin/Login/doLogin",{usercode:$('input[name="usercode"]').val(),password:$('input[name="password"]').val()},
          function(ret,err){
            if(ret.status)
                   {
                        swal({
                                title: "登录成功!",
                                text: ret.msg,
                                type: "success"
                              }, function() {
                                location.href='Admin/Index/Index'
                              });
                        
                   }
                   else
                   {
                        swal({
                                title: "登录失败!",
                                text: ret.msg,
                                type: "error"
                              }, function() {
                                $("#username").focus();
                              });
                   }
          },
          "json");//这里返回的类型有：json,html,xml,text
  })
}


//回车
var formEnterEvent = function() {
  $("#username").keypress(function(e) {
    if(e.keyCode == 13) {
      $("#password").focus();
    }
  });

  $("#password").keypress(function(e) {
    if(e.keyCode == 13) {
      $("#login").click();
    }
  });
}