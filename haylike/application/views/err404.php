<!doctype html>
<html>
 <head>
   <title>404 Page Not Found</title>
   <style>
   body{
     width: 99%;
     height: 100%;
     background-color: mediumturquoise;
     color: white;
     font-family: sans-serif;
   }
   div {
     position: absolute;
     width: 400px;
     height: 300px;
     z-index: 15;
     top: 45%;
     left: 50%;
     margin: -100px 0 0 -200px;
     text-align: center;
   }
   h1,h2{
     text-align: center;
   }
   h1{
     font-size: 60px;
     margin-bottom: 10px;
     border-bottom: 1px solid white;
     padding-bottom: 10px;
   }
   h2{
     margin-bottom: 40px;
   }
   a{
     margin-top:10px;
     text-decoration: none;
     padding: 10px 25px;
     background-color: ghostwhite;
     color: black;
     margin-top: 20px;
   }
   </style>
 </head>
 <body>
   <div>
     <h1>404</h1>
     <h2>Không tìm thấy trang này !</h2>
     <a href='<?= base_url(); ?>' >Quay trở lại trang chủ</a>
   </div>
 </body>
</html>