<div class="tabs-block news-list-block">
    <div class="title-block">
       
        <div class="breadcrumb">
            <ul class="clearfix">
                <li><a href="">Trang chủ</a></li>
                <li><?php echo $chuyenmuc ?></li>
            </ul>
        </div>
    </div>
  <div class="txt-content">
     <ul class="news-list clearfix" id="content">
        
        <?php foreach($list as $row) { ?>
            <li class="listItem">
                <a href="<?php echo $row->slug ?>">
                    <div class="date"><?php echo $row->ngay ?></div>
                    <div class="txt"><?php echo $row->tieude ?></div>
                </a>
            </li>
        <?php } ?>
        <center>
            <div id="pagination-container">
                <p class='paginacaoCursor' id="beforePagination">Trang đầu </p>
                <p class='paginacaoCursor' id="afterPagination">Trang cuối</p>
            </div>
        </center>
    </ul>
   
    </div>
</div>
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo public_url('') ?>/src/jquery.paginate.js"></script>
 <script>
$(document).ready(function(){

  var HZperPage = 5,//number of results per page
     HZwrapper = 'news-list',//wrapper class
     HZlines   = 'listItem',//items class
     HZpaginationId ='pagination-container',//id of pagination container
     HZpaginationArrowsClass = 'paginacaoCursor',//set the class of pagi
     HZpaginationColorDefault =  '#880e4f',//default color for the pagination numbers
     HZpaginationColorActive = '#311b92', //color when page is clicked
     HZpaginationCustomClass = 'customPagination'; //custom class for styling the pagination (css)


   /*-------------------------F/ AHMED HIJAZI -------------------------*/
   /*------------------------- HOPE YOU LIKE -------------------------*/

  function paginationShow(){if($("#"+HZpaginationId).children().length>8){var a=$(".activePagination").attr("data-valor");if(a>=4){var i=parseInt(a)-3,o=parseInt(a)+2;$(".paginacaoValor").hide(),exibir2=$(".paginacaoValor").slice(i,o).show()}else $(".paginacaoValor").hide(),exibir2=$(".paginacaoValor").slice(0,5).show()}}paginationShow(),$("#beforePagination").hide(),$("."+HZlines).hide();for(var tamanhotabela=$("."+HZwrapper).children().length,porPagina=HZperPage,paginas=Math.ceil(tamanhotabela/porPagina),i=1;i<=paginas;)$("#"+HZpaginationId).append("<p class='paginacaoValor "+HZpaginationCustomClass+"' data-valor="+i+">"+i+"</p>"),i++,$(".paginacaoValor").hide(),exibir2=$(".paginacaoValor").slice(0,5).show();$(".paginacaoValor:eq(0)").css("background",""+HZpaginationColorActive).addClass("activePagination");var exibir=$("."+HZlines).slice(0,porPagina).show();$(".paginacaoValor").on("click",function(){$(".paginacaoValor").css("background",""+HZpaginationColorDefault).removeClass("activePagination"),$(this).css("background",""+HZpaginationColorActive).addClass("activePagination");var a=$(this).attr("data-valor"),i=a*porPagina,o=i-porPagina;$("."+HZlines).hide(),exibir=$("."+HZlines).slice(o,i).show(),"1"===a?$("#beforePagination").hide():$("#beforePagination").show(),a===""+$(".paginacaoValor:last").attr("data-valor")?$("#afterPagination").hide():$("#afterPagination").show(),paginationShow()}),$(".paginacaoValor").last().after($("#afterPagination")),$("#beforePagination").on("click",function(){var a=$(".activePagination").attr("data-valor"),i=parseInt(a)-1;$("[data-valor="+i+"]").click(),paginationShow()}),$("#afterPagination").on("click",function(){var a=$(".activePagination").attr("data-valor"),i=parseInt(a)+1;$("[data-valor="+i+"]").click(),paginationShow()}),$(".paginacaoValor").css("float","left"),$("."+HZpaginationArrowsClass).css("float","left");
})
</script>
<style type="text/css">
  body { background-color: #fafafa; }
  .container { margin-top: 150px; font-family: 'Roboto'; }
    .customPagination, .paginacaoCursor{
      margin: 20px 5px;
      padding: 5px 8px;
      color: #fff;
      background: #880e4f;
      cursor: pointer;
    }
  </style>