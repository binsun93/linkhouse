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
                                <a class="btn btn-default" type="button">Đóng</a>
                            </label>
                        </header>
                        <div class="panel-body">
                            <?php echo $msg; ?>
                            <div id="post_form" class="col-sm-12 left">
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
                                
                                <div class="form-group row-content">
                                    <label class="control-label"><strong>Nội Dung </strong></label>
                                    <textarea class="input_textarea" name="data_post[content]" style="width: 100%;" rows="5" id="aaa"><?php echo $detail[0]->content;?></textarea>
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