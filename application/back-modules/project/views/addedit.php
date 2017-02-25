<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> Home</a>
            </li>
            <li>
                <a href="<?php echo base_url().$this->uri->segment(1)?>">
                    <?php echo $title_module;?>
                </a>
            </li>
            <li class="active">Thêm / Sửa bài viết</li>
        </ul>
        <div class="row">
            <div class="col-sm-12">
                <form class="form-horizontal" id="frm_add_edit" method="post" enctype="multipart/form-data">
                    <section class="panel panel-default">
                        <header class="control-fixed panel-heading font-bold" data-top="49">
                            <label style="line-height: 33px;">Thêm / Sửa nội dung</label>
                            <label class="pull-right">
                                <button type="submit" class="btn btn-primary">Lưu lại</button>
                                <a class="btn btn-default" type="button" href="<?php echo base_url().$this->uri->segment(1)?>">Đóng</a>
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
                                    $(".scrollable").scroll(function() {
                                        var elem = $('.control-fixed'); //alert("sdfsdf");
                                        if (!elem.attr('data-top')) {
                                            if (elem.hasClass('navbar-fixed-top'))
                                                return;
                                            var offset = elem.offset()
                                            elem.attr('data-top', offset.top);
                                        }
                                        if (elem.attr('data-top') <= $(this).scrollTop())
                                            elem.addClass('navbar-fixed-top');
                                        else
                                            elem.removeClass('navbar-fixed-top');
                                    });
                                </script>
                                <div class="form-group has-success">
                                    <div class="col-sm-12" style="padding-left:0px">
                                        <label class="col-sm-1 control-label" style="margin-bottom: 5px; text-align: left;">
                                            <strong>Tiêu đề</strong>
                                        </label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" name="data_post[title]" class="form-control" value="<?php echo $detail[0]->title; ?>">
                                    </div>
                                </div>
                                <div class="form-group has-success">
                                    <div class="col-sm-12" style="padding-left:0px">
                                        <label class="col-sm-1 control-label" style="margin-bottom: 5px; text-align: left;">
                                            <strong>Giá trị</strong>
                                        </label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" name="data_post[price]" class="form-control input_number_text" value="<?php echo $detail[0]->price; ?>">
                                    </div>
                                </div>
                                <div class="form-group has-success">
                                    <div class="col-sm-12" style="padding-left:0px">
                                        <label class="col-sm-1 control-label" style="margin-bottom: 5px;  text-align: left;"><strong>Mô tả</strong>
                                        </label>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea rows="5" name="data_post[description]" id="summary_profle" class="form-control">
                                            <?php echo $detail[0]->description; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <section class="panel panel-default">
                                    <header class="panel-heading font-bold">Image</header>
                                    <div class="panel-body">
                                        <b>Image :</b>
                                        <br />
                                        <div class="input-append">
                                            <input id="fieldIDbanner" class="image" type="text" name="data_post[image]" value="<?php echo $detail[0]->image; ?>" style="height:33px" hidden>
                                            <a style="margin-left: 40%;" href="../themes/admincp/js/tinymce/filemanager/dialog.php?type=1&amp;field_id=fieldIDbanner" class="btn btn-primary iframe-btn" type="button">Select</a>
                                        </div>
                                        <br />
                                        <?php //if($detail[0]->image){?>
                                        <img id="image_old_fieldIDbanner" src="<?php echo $detail[0]->image; ?>" width="100%" height="100%" />
                                        <?php //} ?>
                                    </div>
                                </section>
                                <section class="panel panel-default">
                                    <header class="panel-heading font-bold">Files</header>
                                    <div class="panel-body">
                                        <b>Files :</b>
                                        <br />
                                        <div class="input-append">
                                            <input name="upload[]" type="file" multiple="multiple" />
                                        </div>
                                        <?php if($detail[0]->file !== ''): ?>
                                        <div>
                                            <span>Các file bạn đang có</span>
                                            <ul>
                                                <?php 
                                                $array_files = explode(',', $detail[0]->file);
                                                foreach($array_files as $file):
                                                ?>
                                                <li>
                                                    <input type="hidden" name="files[]" value="<?php echo $file; ?>">
                                                    <a title="<?php echo $file; ?>" href="/themes/uploadFiles/<?php echo $file; ?>" target="_blank" download><?php echo cut_string($file, 30); ?></a>
                                                    <span style="color: red;right: 10%;position: absolute;cursor: pointer;" onclick="$(this).parent().remove();">X</span>
                                                </li>
                                            <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </section>
                                <section class="panel panel-default">
                                    <header class="panel-heading font-bold">Trạng thái nổi bật</header>
                                    <div class="panel-body">
                                        <div class="col-sm-12">
                                            <label>Nổi bật</label>
                                            <select name="data_post[is_hot]" id="menus_parent_video" class="form-control">
                                                <option value="1" <?php if ($detail[0]->is_hot == 1) { ?>selected
                                                    <?php } ?>>
                                                    <?php echo 'Yes'; ?>
                                                </option>
                                                <option value="0" <?php if ($detail[0]->is_hot == 0) { ?>selected
                                                    <?php } ?>>
                                                    <?php echo 'No'; ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </section>
                                <section class="panel panel-default">
                                    <header class="panel-heading font-bold">Trạng thái</header>
                                    <div class="panel-body">
                                        <div class="col-sm-12">
                                            <label>Trạng Thái Sử Dụng</label>
                                            <select name="data_post[status]" id="menus_parent_video" class="form-control">
                                                <option value="1" <?php if ($detail[0]->status == 1) { ?>selected
                                                    <?php } ?>>
                                                    <?php echo 'Public'; ?>
                                                </option>
                                                <option value="0" <?php if ($detail[0]->status == 0) { ?>selected
                                                    <?php } ?>>
                                                    <?php echo 'Unpublic'; ?>
                                                </option>
                                                <option value="2" <?php if ($detail[0]->status == 2) { ?>selected
                                                    <?php } ?>>
                                                    <?php echo 'Delete'; ?>
                                                </option>
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
                    </section>
                </form>
            </div>
        </div>
    </section>
</section>
<script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/js/jquery.inputmask.bundle.js" type="text/javascript"></script>
<script>
    function responsive_filemanager_callback(field_id) {
        var url = jQuery('#' + field_id).val();
        $('#image_old_' + field_id).attr('src', url);
    }
    responsive_filemanager_callback('fieldIDbanner');
    responsive_filemanager_callback('fieldIDposter');
    $(document).ready(function(e) {
        $('.aut_img_poster').each(function(index, element) {
            $(this).error(function() {
                $(this).hide();
            });
        });
        $('.aut_img_banner').each(function(index, element) {
            $(this).error(function() {
                $(this).hide();
            });
        });
    });

    function readURL_banner(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah_banner').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURL_poster(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah_poster').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('.input_number_text').number(true);
</script>