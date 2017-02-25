<section class="vbox">
          <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
              <li><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> Home</a></li> 
              <li><a href="<?php echo base_url().$this->uri->segment(1)?>" ><?php echo $title_module; ?></a></li>
            </ul>
          
          
                <header class="panel-heading">
                <b><?php echo $title_module; ?></b>
                
                </header> 
                <form id="form1" method="get">
                     <!-- .nav-justified -->
                      <section class="panel panel-default">
                        <header class="panel-heading bg-light">
                          <ul class="nav nav-tabs nav-justified">
                            <li style="width: 120px;" <?php echo $type=="all"?"class='active'":""?>><a href="#idList" onclick="changeTab('all')" data-toggle="tab"><i class="fa fa-list"></i> All</a></li>
                            
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
</script>