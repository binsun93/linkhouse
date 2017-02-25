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

                                <div id="post_form" class="col-sm-8 left">
                                    <div class="form-group has-success">
                                        <div class="col-sm-12" style="padding-left:0px">
                                            <label class="col-sm-3 control-label" style="margin-bottom: 5px; text-align: left;"><strong>Tiêu đề</strong>
                                            </label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="text" name="data_post[title]" class="form-control" value="<?php echo $detail[0]->title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <div class="col-sm-12" style="padding-left:0px">
                                            <label class="col-sm-1 control-label" style="margin-bottom: 5px; text-align: left;"><strong>Slug</strong>
                                            </label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="text" name="data_post[slug]" class="form-control" value="<?php echo $detail[0]->slug; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <div class="col-sm-12" style="padding-left:0px">
                                            <label class="col-sm-12 control-label" style="margin-bottom: 5px; text-align: left;"><strong>Video youtube (lưu ý ngoài link youtube sẽ không chấp nhận)</strong>
                                            </label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="text" name="data_post[video]" class="video-youtube form-control" value="<?php echo $detail[0]->video; ?>">
                                                <object id="embed-video" width="420" height="315" data="">
                                                </object>
                                        </div>
                                        <script>
                                            $('#embed-video').attr('data', 'https://www.youtube.com/embed/' + getVideoId($('.video-youtube').val()));
                                            function getVideoId(url){
                                                if(url.indexOf('?') != -1 ) {
                                                    var query = decodeURI(url).split('?')[1];
                                                    var params = query.split('&');
                                                    for(var i=0,l = params.length;i<l;i++)
                                                        if(params[i].indexOf('v=') === 0)
                                                            return params[i].replace('v=','');
                                                } else if (url.indexOf('youtu.be') != -1) {
                                                    return decodeURI(url).split('youtu.be/')[1];
                                                }
                                                return null;
                                            }
                                            $(".video-youtube").change(function() {
                                                $('#embed-video').attr('data', 'https://www.youtube.com/embed/' + getVideoId($(this).val()));
                                            });
                                        </script>
                                    </div>
                                </div>

                                <div class="form-group has-success">
                                    <div class="col-sm-12" style="padding-left:0px">
                                        <label class="col-sm-3 control-label" style="margin-bottom: 5px;  text-align: left;"><strong>Mô tả</strong>
                                        </label>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea class="input_textarea" name="data_post[content]" style="width: 100%;" rows="5" id="aaa">
                                            <?php echo $detail[0]->content;?></textarea>
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
                                        <?php if($detail[0]->image){?>
                                        <img id="image_old_fieldIDbanner" src="<?php echo $detail[0]->image; ?>" width="100%" height="100%" />
                                        <?php } ?>
                                    </div>
                                </section>
                                <section class="panel panel-default">
                                    <header class="panel-heading font-bold">Thời gian diển ra</header>
                                    <div class="panel-body">
                                        <div class="col-sm-12" style="display: flex;">

                                            <input type="text" data-date-format="dd/mm/yyyy" size="16" style="width:120px;" class="input-s-sm input-s dateimtepk form-control hasDatepicker" id="date_sort_start" name="data_post[start_date]" value="<?php echo date('Y-m-d', strtotime($detail[0]->start_date)); ?>" />
                                            <span class="input-group-addon" style="width: 40px;">to</span>
                                            <input type="text" data-date-format="dd/mm/yyyy" size="16" style="width:120px;" class="input-s-sm input-s dateimtepk form-control hasDatepicker" id="date_sort_end" name="data_post[end_date]" value="<?php echo date('Y-m-d', strtotime($detail[0]->end_date)); ?>" />
                                            <script>
                                                $(function() {
                                                    $(".dateimtepk").datepicker({
                                                        format: "yyyy/mm/dd",
                                                        language: "vi",
                                                        onSelect: function(dateText, inst) {
                                                            $("input[name='data_post[end_date]']").val(dateText);
                                                        }
                                                    });
                                                });
                                            </script>
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