<?php 
$member = $this->load->model('member/member_model');
$member->where('status', 1);
$total_member = $member->get()->num_rows();

$order = $this->load->model('order/order_model');
$total_order = $order->get()->num_rows();

$product = $this->load->model('product/product_model');
$total_product = $product->get()->num_rows();

$post = $this->load->model('posts/posts_model');
$total_post = $post->get()->num_rows();
?>
<section id="content">
  <section class="vbox">          
    <section class="scrollable padder">
      <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
        <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Workset</li>
      </ul>
      <div class="m-b-md">
        <h3 class="m-b-none">Thông tin hoạt động</h3>
      </div>
      <section class="panel panel-default">
        <div class="row m-l-none m-r-none bg-light lter">
          <div class="col-sm-6 col-md-3 padder-v b-r b-light">
            <span class="fa-stack fa-2x pull-left m-r-sm">
              <i class="fa fa-circle fa-stack-2x text-info"></i>
              <i class="fa fa-male fa-stack-1x text-white"></i>
            </span>
            <a class="clear" href="#">
              <span class="h3 block m-t-xs"><strong><?php echo $total_member;?></strong></span>
              <small class="text-muted text-uc">Tổng người dùng</small>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
            <span class="fa-stack fa-2x pull-left m-r-sm">
              <i class="fa fa-circle fa-stack-2x text-warning"></i>
              <i class="fa fa fa-shopping-cart fa-stack-1x text-white"></i>
              <span class="easypiechart pos-abt easyPieChart" data-percent="100" data-line-width="4" data-track-color="#fff" data-scale-color="false" data-size="50" data-line-cap="butt" data-animate="2000" data-target="#bugs" data-update="3000" style="width: 50px; height: 50px; line-height: 50px;"><canvas width="50" height="50"></canvas></span>
            </span>
            <a class="clear" href="#">
              <span class="h3 block m-t-xs"><strong id="bugs"><?php echo $total_order;?></strong></span>
              <small class="text-muted text-uc">Tổng đơn hàng</small>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 padder-v b-r b-light">                     
            <span class="fa-stack fa-2x pull-left m-r-sm">
              <i class="fa fa-circle fa-stack-2x text-danger"></i>
              <i class="fa fa fa-tasks fa-stack-1x text-white"></i>
              <span class="easypiechart pos-abt easyPieChart" data-percent="100" data-line-width="4" data-track-color="#f5f5f5" data-scale-color="false" data-size="50" data-line-cap="butt" data-animate="3000" data-target="#firers" data-update="5000" style="width: 50px; height: 50px; line-height: 50px;"><canvas width="50" height="50"></canvas></span>
            </span>
            <a class="clear" href="#">
              <span class="h3 block m-t-xs"><strong id="firers"><?php echo $total_product;?></strong></span>
              <small class="text-muted text-uc">Tổng sản phẩm</small>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
            <span class="fa-stack fa-2x pull-left m-r-sm">
              <i class="fa fa-circle fa-stack-2x icon-muted"></i>
              <i class="fa fa fa-pencil-square-o fa-stack-1x text-white"></i>
            </span>
            <a class="clear" href="#">
              <span class="h3 block m-t-xs"><strong><?php echo $total_post;?></strong></span>
              <small class="text-muted text-uc">Tổng bài viết</small>
            </a>
          </div>
        </div>
      </section>
      <section class="panel panel-default" id="progressbar">
          <header class="panel-heading">
            <!--<ul class="nav nav-pills pull-right">
              <li><a href="#" data-toggle="progress" data-target="#progressbar">Random</a></li>
            </ul>-->
            Chat
          </header>
            <div class="panel-body" style=" height: 300px;">     
                      <iframe style="width: 100%;height:100%; border: medium none;" src="<?php echo base_url()."comments/";  ?>"></iframe>
            </div>
        </section>
    
  </section>
  <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
<script src="<?php echo $this->config->item('admin_url');?>/themes/admincp/scripts/highcharts/highcharts.js"></script>