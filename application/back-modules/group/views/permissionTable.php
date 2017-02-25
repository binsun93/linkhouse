
<div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th onclick="multiSort(this, function(){alert('single')}, function(){alert('double')}, 'except_id')" style="width: 60px; color: blue;" class="th-sortable" data-toggle="class">ID
                            <span class="th-sort" id="iconSort_except_id" style="<?=!isset($orderBy['except_id'])?"display: none;":""?>">
                                <i class="fa fa-sort-down text<?=$orderBy['except_id']=="asc"?"-active":""?>"></i>
                                <i class="fa fa-sort-up text<?=($orderBy['except_id']=="desc" || !isset($orderBy['except_id']))?"-active":""?>"></i>
                                <i class="fa fa-sort"></i>
                              </span>
                        </th>
                        <th >Link Except</th> 
                        <th >Date</th>
                        <th >Status</th>
                        <th >Tool</th>
                      </tr>
                    </thead>
                    
                    
                    
                    <tbody>

                    <?php
                    $start = $i = (($page-1)*$numRowForPage)+1;
                    
                    if (!empty($content)) {
                        foreach ($content as $row) { 
                        ?>
                        <tr id="<?php echo 'tr_' . $row->except_id; ?>">
                            <td><?=$i++?></td>
                            <td><?php echo $row->admin_group_id; ?></td>   
                            <td><?php echo $row->url_except; ?></td> 
                            <td><?php echo "<b>Create date:</b> ".$row->create_date."<br />";
                                    echo "<b>Modify date:</b> ".$row->modify_date."<br />";
                             ?></td> 
                            <td>
                               
                                <div class="btn-group">
        		                  <i  data-toggle="dropdown">
                                    <?php
                                    if($row->status == 0){
                                        ?><a href="javascript:void(0)"  title="Unpublish"><img src="<?=$this->config->item('img_path')?>150x150/icon/error.png" height="20px" width="20px" /></a><?php
                                    }
                                    if($row->status == 1){
                                        ?><a href="javascript:void(0)"  title="Publish"><img src="<?=$this->config->item('img_path')?>150x150/icon/success.png" height="20px" width="20px" /></a> <?php
                                    }
                                    if($row->status == 2){
                                        ?><a href="javascript:void(0)"  title="Trash"><img src="<?=$this->config->item('img_path')?>150x150/icon/trash.png" height="20px" width="20px" /></a><?php
                                    } 
                                    ?>
                                  </i>
        		                  <ul class="dropdown-menu"> 
                                    <?php 
                                    if($row->status != 0){
                                        ?><li><a id="td_<?php echo $row->except_id; ?>" href="javascript:change(0 ,'<?=$row->except_id?>')">
                                        <img src="<?=$this->config->item('img_path')?>150x150/icon/error.png" height="20px" width="20px" />
                                        UnPublish</a></li><?php
                                    }
                                    if($row->status != 1){
                                        ?><li><a id="td_<?php echo $row->except_id; ?>" href="javascript:change(1 ,'<?=$row->except_id?>')">
                                         <img src="<?=$this->config->item('img_path')?>150x150/icon/success.png" height="20px" width="20px" />
                                         Publish</a></li><?php
                                    }
                                    if($row->status != 2){
                                        ?><li><a id="td_<?php echo $row->except_id; ?>" href="javascript:deleteBanner(<?php echo $row->except_id; ?>);">
                                        <img src="<?=$this->config->item('img_path')?>150x150/icon/trash.png" height="20px" width="20px" />
                                        Trash</a></li><?php
                                    } 
                                    ?>
                                    </ul>
        		                </div>
                                
                                
                            </td>
                            <td>
                                <span>
                                    <a href="javascript:deletePer(<?php echo $row->except_id; ?>);" title="Delete">
                                        <img src="<?=$this->config->item('img_path')?>150x150/icon/trash.png" height="20px" width="20px" />
                                    </a>
                                </span>
                            </td>                
                        </tr>
                        
                        <?php
                    }}$end = $i-1;
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- page num -->
            
                <div class="boxAll pageNum" >
                    <div class="page">
                        <?php
                        
                        $buildLink = $this->load->library('Model_Build');
                       
                        $buildLink->buildPage($numRowForPage , $page , $start , $end , $totalRow);
                        ?>
                    </div>
                </div>
                <input type="hidden" name="mulSort" id="mulSort" value="<?=$mulSort?>" />
                <!-- en page num -->
<script>


$(function() {
      $('#numPerPage').change(function() {
            $('#form1').submit();
      });
});
$(function() {
      $('#txtpage').change(function() {
            $('#form1').submit();
      });
});


</script>