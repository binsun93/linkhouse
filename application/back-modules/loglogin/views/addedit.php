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
                    <label class="col-sm-3 control-label">Url thực</label>
                    <div class="col-sm-9">
                      <input type="text" name="data_post[realurl]" class="form-control" value="<?php echo $detail[0]->realurl; ?>">
                    </div>
                  </div>
                <div class="form-group has-success">
                    <label class="col-sm-3 control-label">Đổi thành </label>
                    <div class="col-sm-9">
                      <input type="text" name="data_post[aliasurl]" class="form-control" value="<?php echo $detail[0]->aliasurl; ?>">
                    </div>
                  </div>
                    <div class="form-group has-success">
                    <label class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                      <input type="text" name="data_post[mtitle]" class="form-control" value="<?php echo $detail[0]->mtitle; ?>">
                    </div>
                  </div>
                  <div class="form-group has-success">
                    <label class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                      <input type="text" name="data_post[mdescription]" class="form-control" value="<?php echo $detail[0]->mdescription; ?>">
                    </div>
                  </div>
                  <div class="form-group has-success">
                    <label class="col-sm-3 control-label">Keyword</label>
                    <div class="col-sm-9">
                      <input type="text" name="data_post[mkeyword]" class="form-control" value="<?php echo $detail[0]->mkeyword; ?>">
                    </div>
                  </div>
                  <!--
                  <div class="form-group has-success">
                    <label class="col-sm-3 control-label">Image</label>
                    <div class="col-sm-9">
                      <input type="text" name="data_post[mimage]" class="form-control" value="<?php echo $detail[0]->mimage; ?>">
                    </div>
                  </div>
                  -->
                  <div class="form-group has-success">
                    <label class="col-sm-3 control-label">Video</label>
                    <div class="col-sm-9">
                      <input type="text" name="data_post[mvideo]" class="form-control" value="<?php echo $detail[0]->mvideo; ?>">
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

                    <script type="text/javascript">
                        $(document).ready(function (e) {
                            $('.aut_img').each(function (index, element) {
                                $(this).error(function () {
                                    $(this).hide();
                                });
                            });
                        });
                        function readURL(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function (e) {
                                    $('#blah').attr('src', e.target.result).show();
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>
                    <section class="panel panel-default">
                        <header class="panel-heading font-bold">Hình ảnh</header>
                        <div class="panel-body">     
                            <div class="col-sm-12"> 
                                <a title="<div>Kích thước chuẩn:<div> <div>364x226 - .jpg .png .gif</div>Dung lượng tối đa: 2Mb ">
                                    <input type="file" onChange="readURL(this);" name="img" id="img" > <br />
                                </a>
                                <?php
                                if ($obj->image) {
                                    ?><label for="hinhanh">Hình Cũ</label>
                                    <img src="<?php echo $this->config->item("img_path"). $obj->image; ?>" width="100%" height="100%" />
                                    <br>
                                    <label for="hinhanh">Hình Mới</label>
                                    <?php
                                }
                                ?><img class="aut_img" id='blah' src='' style=" max-width: 100%; max-height: 100%;" />
                                 
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
