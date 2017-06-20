<?php
         $code = rand(1000,9999);//随机生成一个验证码
         $md_code = md5($code);
         setcookie("emailcode",$md_code,time()+2*60); //将验证码存储在cookie中，并设置两分钟过期

        include("phpmailer/class.phpmailer.php");
        $mail             = new PHPMailer();//实例化一个邮件发送类
        $body             = "Verification code：$code";//设置邮件发送内容
        $mail->IsSMTP(); // telling the class to use SMTP 使用smtp协议发送
        $mail->SMTPDebug  = 0;//错误调试：0表示不打开错误调试
        $mail->SMTPAuth   = true;
        $mail->CharSet    = "utf-8";
        $mail->Host       = "smtp.163.com"; // sets the SMTP server 设置发送邮件服务器，如：smtp.qq.com
        $mail->Port       = 25;                    // set the SMTP port for the GMAIL server 邮件发送服务的端口
        $mail->Username   = "18336253749@163.com"; // SMTP account username 发送邮件的邮箱用户名，如：123@qq.com
        $mail->Password   = "sx18336253749";        // SMTP account password 发送邮件的邮箱密码，如：123456，是123@qq.com的密码
        $mail->SetFrom('18336253749@163.com', 'sqq');//设置接收来源，如：123@qq.com
        $mail->AddReplyTo("18336253749@163.com","sqq");//回复邮箱，如果别人按回复按钮，会直接指定的回复邮箱
        $mail->Subject    = "Verification code";//标题,主题
        $mail->MsgHTML($body);//内容使用html格式
        
       // $email = $_POST["email"]; //获取需要发送的邮箱地址
        $address =$_SESSION["change_email"];//发送地址，指的是用户注册时填写的地址 */
        
        $mail->AddAddress($address, "用户组");//有多个邮箱地址，使用多次
        // $mail->Send();//发送邮件 
        $mail->Send();

       echo 1;

?>