var time = parseInt(Math.floor(Date.now() / 1000));
document.write('<script src="https://www.google.com/recaptcha/api.js">\x3c/script><link rel="stylesheet" href="bootstrap/css/bootstrap.min.css?_=' + time + '"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css?_=' + time + '"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css?_=' + time + '"><link rel="stylesheet" href="dist/css/AdminLTE.min.css?_=' + time + '"><link rel="stylesheet" href="dist/css/skins/_all-skins.min.css?_=' + time + '"><link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css?_=' + time + '"><link href="src/animate.css?_=' + time + '" rel="stylesheet" type="text/css" /><link href="src/duy98.css?_=' + time + '" rel="stylesheet" type="text/css" /><link href="src/profile.css?_=' + time + '" rel="stylesheet" type="text/css" /><link href="bootstrap/fonts.css?_=' + time + '" rel="stylesheet" type="text/css" /><link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.7/sweetalert2.min.css" rel="stylesheet" /><script src="plugins/jQuery/jquery-3.1.1.min.js?_=' + time + '">\x3c/script><script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.7/sweetalert2.min.js">\x3c/script><script src="src/jCarouselLite/jquery-1.11.1.js">\x3c/script><script src="bootstrap/js/bootstrap.min.js">\x3c/script><script src="src/wow.js">\x3c/script><script src="inc/js/noti.js">\x3c/script><script src="dist/js/adminlte.js?_=' + time + '">\x3c/script><script src="plugins/datatables/jquery.dataTables.min.js?_=' + time + '">\x3c/script><script src="plugins/datatables/dataTables.bootstrap.min.js?_=' + time + '">\x3c/script><script src="plugins/ckeditor/ckeditor.js?_=' + time + '">\x3c/script><script src="inc/js/ext.js">\x3c/script>');
(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=350685531728";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        function logouts(){
            swal({
              title: 'Bạn có chắc chắn muốn đăng xuất?',
              text: "HETHONGSONGAO_COM",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Vâng, Tôi muốn!',
              cancelButtonText: 'Trở về'
            }).then(function() {
              location.href = "/logout.php";
            })
        }
          window.onload = function(){
      document.getElementById('warning').click();
  };
var time = parseInt(Math.floor(Date.now() / 1000));
document.write("<script src=\"plugins/datatables/jquery.dataTables.min.js?_=" + time + "\"></script><script src=\"plugins/datatables/dataTables.bootstrap.min.js?_=" + time + "\"></script><script src=\"inc/js/ext.js?_=<?= time(); ?>\"></script>")
