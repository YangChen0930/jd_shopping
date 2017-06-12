<?php
header('Content-Type:text/html;charset=UTF-8');
?>
<div class="modal-dialog">
  <div class="modal-content">
   <h4>用户登录</h4>
   <p class="alert">
      请在此处输入您的注册信息。
   </p>
   <form id="login-form">
		<input type="text" placeholder="请输入登录用户名" name="uname">
		<input type="password" placeholder="请输入登录密码" name="upwd">
		<input type="button" value="提交登录信息" id="bt-login">
   </form>
 </div>
</div>