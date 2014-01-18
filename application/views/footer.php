
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script>
    function ct(ta){
        var textarr = ["ideas","projects","inventions","concepts","designs","innovations","creations","products","thoughts"];
        var it = $('#ideatext');
        if(ta==textarr.length){
          ta=0;
        }
        it.animate({'opacity':0},700,function(e){
          it.html(textarr[ta]);
          ta++;
          it.animate({'opacity':1},700,function(e){
              setTimeout(ct(ta),400);
            });
        });     
    }

      jQuery(document).ready(function($) {
        $('.item').on('mouseover', function(){
          $(this).addClass("itembg");
        });
        $('.item').on('mouseout', function(){
          $(this).removeClass("itembg");
        });
        ct(1);
        $('#ip').tooltip('hide');
        $('#vshare').on('click', function(){
          var vl = $('#vlink').val();
          var ti = $('#vtitle').val();
          var type = $('#type').val();
          var desc = $('#desc').val();
          var postData = {
            'title':ti,
            'type':type,
            'desc':desc,
              'link' : vl
            };
      $.ajax({
         type: "POST",
         url: "<?php echo base_url('addc');?>",
         data: postData,
         success: function(e){
          if(e=="added"){
            $('#vlink').html('');
            $('#vtitle').html('');
            alert("added"+e);
          } else{
            alert("not added"+e);
          }
         }
      });
        });
        $('#sharebtn').on('click', function() {
          var disabled = $(this).hasClass('disabled');
          if(!disabled){
            $('#sharer').css({'opacity':0,'height':'0px','display':'block'});
        $('#sharer').animate({'opacity':1,'height':'100px'},300,function(e){
          $('#sharer').css({'height':'100%'});
        });
        $('#sharebtn').addClass('disabled');      
          }
        });       
        $('#closesharer').on('click', function() {
      $('#sharer').animate({'opacity':0.0,'height':'0px'},300,function(e){
        $('#sharer').css({'display':'none'});
        $('#sharebtn').removeClass('disabled');
      });
        });       
      });    
    </script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43143418-1', 'trishulam.com');
  ga('send', 'pageview');

</script>

  </body>
</html>
