<!DOCTYPE html>
<html>

<head>
	<title>로그인</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="Author" content="">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<meta name="format-detection" content="telephone=no">

	<link href="/skin/img/favicon_57.ico" rel="shortcut icon">
	<link href="/skin/img/bookmark_simbol.png" rel="apple-touch-icon-precomposed">
	<link rel="stylesheet" type="text/css" href="/admin/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/admin/css/style.css?v=<?=time()?>">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

	<!--[if lt IE 9]>
	<script src="/skin/js/respond.min.js"></script>
	<script src="/skin/js/html5.js"></script>
	<![endif]-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/admin/js/jquery-ui.js"></script>
	<script src="/admin/js/common.js"></script>


</head>
<body>

    <div id="admin_body" class="full">
        <div class="body">

            <div id="install">

                <form id="loginfrm" method="post" action="./indb_install.php" target="ifrmh">

                    <section>
        				<h2>관리자</h2>
        				<input type="text" name="uid" value="" placeholder="이메일" required="required">
        				<input type="password" name="upw" value="" placeholder="패스워드(6자 이상)" required="required">
        				<input type="password" name="upw2" value="" placeholder="패스워드 확인(6자 이상)" required="required">
        			</section>


        			<section>
        				<h2>데이터베이스</h2>
        				<input type="text" name="db_host" value="localhost" required="required" placeholder="호스트">
        				<input type="text" name="db_name" value="" placeholder="데이터베이스 이름" required="required">
        				<input type="text" name="db_id" value="" placeholder="아아디" required="required">
        				<input type="password" name="db_pw" value="" placeholder="패스워드" required="required">
        			</section>


                    <input type="submit" value="설치하기">

                </form>
                <span>Copyright 2017. work6.kr All Rights Reserved.</span>
            </div>

        </div>

    </div>

<iframe id="ifrmh" name="ifrmh" src="" style="display:none;"></iframe>
</body>
</html>
