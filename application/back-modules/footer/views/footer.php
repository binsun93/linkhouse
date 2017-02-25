    <?php if(!$_GET['iframe']){?>
           <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>
  <section class="panel panel-default" id="view_image" style="position: fixed;top: 20%;left: 40%;z-index:1000000;display:none;min-height:100px;min-width:150px">
      <header class="panel-heading">
      	<span class="h4">Xem ảnh</span>
        <a href="javascript:void()" onClick="$('#view_image').hide();" class="btn btn-xs btn-danger pull-right">Đóng</a>
      </header>
      <div class="panel-body" style="text-align:center;">
      </div>
    </section>
    <?php } ?>
  <div class="wait_model"><img src="<?php echo $this->config->item('admin_url');?>/themes/admincp/images/progress.gif" /></div>
    <style>
#slide_image .bootstrap-filestyle label {margin-top: -4px;}
</style>
	<!-- Bootstrap -->
	<script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/js/bootstrap.js"></script>
	<!-- App -->
	<script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/js/app.js"></script> 
	
	<script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/js/nestable/jquery.nestable.js"></script>

	<!-- file input -->  
	<script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/js/file-input/bootstrap-filestyle.min.js"></script>
	<!-- select2 -->
	<script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/js/select2/select2.min.js"></script>
	<script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/js/sortable/jquery.sortable.js"></script>
	
	
	
	<script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/js/app.plugin.js"></script> 
	<script type="text/javascript" src="<?php echo $this->config->item('admin_url').'/themes/admincp/js/tinymce/tinymce/tinymce.min.js';?>"></script>
        
	<script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/js/fileupload/vendor/jquery.ui.widget.js"></script>
	<script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/js/fileupload/jquery.iframe-transport.js"></script>
    <script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/js/fileupload/jquery.fileupload.js"></script>
    <script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/scripts/ajaxfileupload.js"></script>
    <script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/scripts/jquery-ui.js"></script>
     <!-- datepicker -->
	<script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/js/datepicker/bootstrap-datepicker.js"></script>
    
    <script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/scripts/yt_libs.js"></script>
    
   
	<script>
 var site_root_domain = "<?php echo $this->config->item('admin_url'); ?>";
	tinymce.init({

	    selector: "textarea.input_textarea",
	    theme: "modern",
	    width: 718,
	    height: 300,
	    relative_urls : false,
	    remove_script_host: false,
	    plugins: [
	         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
	         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	         "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
	   ],
	   content_css: site_root_domain+"themes/front/css/detail_content.css",
	   entities : "160,nbsp,162,cent,8364,euro,163,pound",
	   skin: 'light',
	   toolbar1: "insertfile undo redo | fontselect fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fullscreen charmap searchreplace", 
	   toolbar2: "image media | link unlink anchor pagebreak | print preview fullpage | forecolor backcolor emoticons",
	   style_formats: [
	        {title: "Bold text", inline: "b"},
	        {title: "Red text", inline: "span", styles: {color: "#ff0000"}},
	        {title: "Red header", block: "h1", styles: {color: "#ff0000"}},
	        {title: "Example 1", inline: "span", classes: "example1"},
	        {title: "Example 2", inline: "span", classes: "example2"},
	        {title: "Table styles"},
	        {title: "Table row 1", selector: "tr", classes: "tablerow1"}
	    ],
	    external_filemanager_path:site_root_domain+"themes/admincp/js/tinymce/filemanager/",
	    filemanager_title:"Responsive Filemanager" ,
	    external_plugins: { "filemanager" : site_root_domain+"themes/admincp/js/tinymce/filemanager/plugin.min.js"}
	 }); 
		var countimg = 0;
		function showImagaPop($_img,$_h,$_w)
		{
			if ($_img) {
				$("#view_image .panel-body").html("<img src = '"+$_img+"' style='width:"+$_w+";height:"+$_h+";max-width:700px;max-height:500px' />")
				$("#view_image").show()
			}
		}
		$(document).ready(function(e) {
			$('.progress').hide();
			$("#select2-option-clubs").select2();
		});
		function formSubmit()
		{
			var a = document.getElementById('action_group');
			if( a.value == 'del'){
				var msg = "Bạn có muốn di chuyển vào thùng rác không?";
				if (window.location.href.indexOf("posts") == - 1) {
					msg = "Bạn có muốn xóa không?";
				}
				if (confirm(msg))
				{
					$("#action").val($("#action_group").val());
					$("#table_form").submit();
				}
			}
			else if (confirm("Bạn có muốn thực hiện không?"))
			{
				$("#action").val($("#action_group").val());
				$("#table_form").submit();
			}
		}
		function formSubmit_delete()
		{
			var a = document.getElementById('action_group');
			if( a.value == 'del'){
				if (confirm("Bạn có muốn xóa vĩnh viễn không?"))
				{
					$("#action").val($("#action_group").val());
					$("#table_form").submit();
				}
			}
			else{
				if (confirm("Bạn có muốn phục hồi về trạng thái này không?"))
				{
					$("#action").val($("#action_group").val());
					$("#table_form").submit();
				}
			}
		}
		function changeStatus($this)
		{
			var status_activie = false;
			if ($this)
			{
				if ($this.hasClass("active"))
				{
					if ($this.data('type')=="status")
					{
						$param = {status:"pending",id:$this.data('id')};
					}
					else if ($this.data('type')=="banner")
					{
						$param = {banner:"off",id:$this.data('id')};
					}
					else if ($this.data('type')=="ranking")
					{
						$param = {ranking:"off",id:$this.data('id')};
					}
				}
				else
				{
					if ($this.data('type')=="status")
					{
						$param = {status:"publish",id:$this.data('id')};
					}
					else if ($this.data('type')=="banner")
					{
						$param = {banner:"on",id:$this.data('id')};
					}
					else if ($this.data('type')=="ranking")
					{
						$param = {ranking:"on",id:$this.data('id')};
					}
					status_activie = true;
				}
				$.ajax({
					url: $this.data('url'),
					type:"GET",
					dataType:'json',
					data: $param,
					success:function(dat){
						if (dat.status == "success")
						{
							if (!status_activie)
							{
								$this.removeClass("active");
							}
							else
							{
								$this.addClass("active")
							}
						}
						else
						{
							alert(dat.msg);
						}
						},error:function(error){}
					});
			}
			return false;
		}
	</script>
	<script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/fancybox/jquery.fancybox.js" type="text/javascript" ></script>
	<script type="text/javascript">

	$(document).ready(function(e) {
		  $('.iframe-btn').fancybox({
				maxWidth	: '100%',
				maxHeight	: '600px',
				width	: '100%',
				  // height : 600,
				type : 'iframe',
				fitToView : false,
				autoSize : false
		  });
	});
	
	</script>
	<script>
		// $(document).ready(function(e) {
			// ion.sound({
				// sounds: [
					// {
						// alias:"s3",
						// name: "glass"
					// }
				// ],
				// path: "<?php echo $this->config->item('admin_url');?>/themes/admincp/ionsound/sounds/",
				// preload: false,
				// volume: 1.0
			// });
			
		// });
		// function transition() {
			// var total = 0;
			// $.ajax({
				// url: "<?php echo base_url();?>order/ajax_settime/",
				// success: function(data) {
					// $(".html-order-header").html(data);
					// total = $('.item-orders').text();
					// if(total >=1){
						// ion.sound.play("s3", {loop: 5});
					// }
					
				// }
			// });
		// }
		// setInterval(transition, 2000);
		</script>
</body>
</html>
