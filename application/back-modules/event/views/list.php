<section class="vbox">
          <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
              <li><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> Home</a></li> 
              <li><a href="<?php echo base_url().$this->uri->segment(1)?>" ><?php echo $title_module; ?></a></li>
            </ul>
          
          
                <header class="panel-heading">
                <b><?php echo $title_module; ?></b>
                <a style="float: right; color: blue;" href="<?php echo base_url($dTbl['module_controler'].'/addedit'); ?>" style="color: blue;">[+]Add New</a>
                </header> 
                <form id="form1" method="get">
                     <!-- .nav-justified -->
                      <section class="panel panel-default">
                        <header class="panel-heading bg-light">
                          <ul class="nav nav-tabs nav-justified">
                            <li style="width: 120px;" <?php echo $type=="all"?"class='active'":""?>><a href="#idList" onclick="changeTab('all')" data-toggle="tab"><i class="fa fa-list"></i> All</a></li>
                            <li style="width: 120px;" <?php echo $type=="1"?"class='active'":""?>><a href="#idList"  onclick="changeTab('1')" data-toggle="tab"><i class="fa fa-bookmark"></i> Publish</a></li>
                            <li style="width: 120px;" <?php echo $type=="0"?"class='active'":""?>><a href="#idList"  onclick="changeTab('0')" data-toggle="tab"><i class="fa fa-bookmark-o"></i> UnPublish</a></li>
                            <li style="width: 120px;" <?php echo $type=="2"?"class='active'":""?>><a href="#idList"  onclick="changeTab('2')" data-toggle="tab"><i class="fa fa-trash-o"></i> Trash</a></li>
                          </ul>
                          
                        </header>
                        
                        <input type="hidden" name="type" id="type" value="<?php echo $type?>" />
                        <div class="panel-body">
                          <div class="tab-content">
                            
                            <div class="well m-t">
                                <?php echo $searchHTML; ?>
                            </div>           
                            <div class="tab-pane active" id="idList"> 
                                <?php echo $listTable?>
                            </div>
                          </div>
                        </div> 
                      </section> 
                </form>
        </section>
</section>    
<script>
    var URL_DO_AJAX = '<?php echo $dTbl['module_controler'];?>';
    function plusTopUse(id)
    {   
          var data = new Object();
          var href      = URL_DO_AJAX+'/plusTopUse'; 
          data.id       = id; 
          $.post(href, data, function(html){
              // Reload ajax page 
              jumpPage('a');
          });
       
    } 
</script>