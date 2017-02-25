<section class="vbox">
          <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
              <li><a href="<?=base_url()?>"><i class="fa fa-home"></i> Home</a></li>
              <li><a href="<?=base_url().$this->uri->segment(1)?>" >Group</a></li>
              <li><a href="<?=base_url().$this->uri->segment(1)?>" >Add/Edit</a></li>
              <?php
              if (isset($id) && $id > 0) {
                    ?> 
                    <li><a href="<?=base_url().$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)?>" >ID: <?=$this->uri->segment(3)?></a></li>
            
                    <?php
                } 
              ?>
            </ul>
            
            
            

    <form action="<?php
    if (isset($id) && $id > 0) {
        echo 'group/addedit/' . $id;
    } else {
        echo 'group/addedit';
    }
    ?>" method="post" id="formadd" onsubmit="return mysubmit();" enctype="multipart/form-data">
                <section class="panel panel-default">
                    <header class="panel-heading bg-light">
                      <b><?=$title?></b>
                    </header>
                    
                    <div class="panel-body">
                        <?php
                        if ($this->session->userdata('message_success')) {
                            ?>
                            <div  style="color: green; font-size: 16px;" >
                                <?php echo $this->session->userdata('message_success'); ?>
                            </div>
                            <?php
                            $this->session->unset_userdata('message_success');
                        }
                        if ($this->session->userdata('message_error')) {
                            ?>
                            <div style="color:red;">
                                <?php echo $this->session->userdata('message_error'); ?>
                            </div>
                            <?php
                            $this->session->unset_userdata('message_error');
                        }
                        ?>
                        <!-- info user -->
                         
                            <div class="form-group">
                            
                                <label class="col-lg-1 control-label"></label>
                                <div class="col-lg-11">
                                    <input class="form-control" placeholder="Name..." id="name" name="name" value="<?php echo (!empty($obj[0]->name)) ? $obj[0]->name : ''; ?>"  type="text" style="width: 350px;"/>
                                </div>
                            <br /><br /><br />
                              <label class="col-lg-1 control-label"></label>
                              <div class="col-lg-11">
                                    <p>
                                        <input name="status" type="radio" value="1" <?php echo (!empty($obj[0]) && $obj[0]->status == 1) ? "checked='checked'" : ''; ?>/> 
                                        
                                        Publish
                                        <input name="status" type="radio" value="0" <?php echo (empty($obj[0]) || $obj[0]->status == 0) ? "checked='checked'" : ''; ?>/> 
                                        
                                        Unpublish
                                        <?php
                                        if (isset($id) && $id > 0) {
                                            ?>
                                            <input name="status" type="radio" value="2" <?php echo (!empty($obj[0]) && $obj[0]->status == 2) ? "checked='checked'" : ''; ?>/> 
                                            
                                            Trash 
                                            <?php   
                                        }
                                        ?>                                     
                                    </p>        
                              </div>
                            </div>
                            
                            <br /><br />
                        <!-- //////////////////////////////////////////////////////////// -->
                            <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-success">Save</button>
                              </div>
                            </div> 
                    </div>
                </section>

    </form>
</section>
    </section>
 	
