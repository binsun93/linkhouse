<section class="vbox">
    <section class="scrollable padder">
      <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
        <li><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo base_url().$this->uri->segment(1)?>" ><?php echo $title_module;?></a></li>
        
        <li class="active">Thêm / Sửa bài viết</li>
      </ul>
      <div class="row">
        <div class="col-sm-12">
          <form class="form-horizontal" id="frm_add_edit" method="post" enctype="multipart/form-data" > 
          <section class="panel panel-default">
            <header class="control-fixed panel-heading font-bold" data-top="49">
                <label style="line-height: 33px;">Thêm / Sửa nội dung</label>
                <label class="pull-right">
                      <button type="submit" class="btn btn-primary">Lưu lại</button>
                      <a class="btn btn-default" type="button" >Đóng</a>
                    </label>
            </header>
            <div class="panel-body">
                <?php echo $msg; ?>
                <div id="post_form" class="col-sm-8 left">
                    <style>
                        
                        .panel-heading.control-fixed {
                            height: 43px;
                            padding: 4px 17px;
                          }
                    </style>
                    <script>
                        $(".scrollable").scroll(function(){
                        var elem = $('.control-fixed');//alert("sdfsdf");
                        if (!elem.attr('data-top')) {
                            if (elem.hasClass('navbar-fixed-top'))
                                return;
                             var offset = elem.offset()
                            elem.attr('data-top', offset.top);
                        }
                        if (elem.attr('data-top') <= $(this).scrollTop() )
                            elem.addClass('navbar-fixed-top');
                        else
                            elem.removeClass('navbar-fixed-top');
                        });
                    
                    </script> 
               
                <div class="form-group has-success">
                    <label class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-9">
                      <input type="text" name="data_post[username]" class="form-control" value="<?php echo $detail[0]->username; ?>">
                    </div>
                </div>
                <div class="form-group has-success">
                    <label class="col-sm-3 control-label">Password (Login)</label>
                    <div class="col-sm-9">
                      <input type="text" name="data_post[password]" class="form-control" value="">
                    </div>
                  </div>
                <div class="form-group"> 
                      <label class="col-sm-3 control-label">Group Admin</label>
                      <div class="col-sm-9">
                          <select name="data_post[admin_group_id]" id="group_admin" class="form-control"> 
                                  <?php
                                  foreach ($group_admin as $cat) { 
                                    ?>
                                    <option value="<?php echo $cat->admin_group_id; ?>" <?php if ($detail[0]->admin_group_id == $cat->id) { ?>selected<?php } ?>> <?php echo $cat->name; ?></option>
                                    <?php  
                                  }
                              ?>
                          </select>
                      </div> 
                  </div>
                  
                </div>
                <div class="col-sm-4">
                    <section class="panel panel-default">
                        <header class="panel-heading font-bold">Trạng thái</header>
                        <div class="panel-body">     
                            <div class="col-sm-12"> 
                                <label>Trạng Thái Sử Dụng</label>
                                <select name="data_post[status]" id="menus_parent_video" class="form-control">
                                    <option value="1" <?php if ($detail[0]->status == 1) { ?>selected<?php } ?>> <?php echo 'Public'; ?></option>
                                    <option value="0" <?php if ($detail[0]->status == 0) { ?>selected<?php } ?>> <?php echo 'Unpublic'; ?></option>
                                    <option value="2" <?php if ($detail[0]->status == 2) { ?>selected<?php } ?>> <?php echo 'Delete'; ?></option>
                                </select>
                                 
                            </div> 
                        </div>
                    </section> 
				
 
                </div>
                <div id="" class="col-sm-12">
                    <div class="line line-dashed line-lg pull-in"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2"> 
                       <button type="submit" class="btn btn-primary">Lưu lại</button>
                    </div>
                  </div>
              </div>
                </div>
              
            </section></form></div>
          </div></section>
                
         
</section> 
