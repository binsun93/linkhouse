
<div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th onclick="multiSort(this, function(){alert('single')}, function(){alert('double')}, '<?php echo $dTbl['module_id']; ?>')" style="width: 60px; color: blue;" class="th-sortable" data-toggle="class">ID
                            <span class="th-sort" id="iconSort_<?php echo $dTbl['module_id']; ?>" style="<?=!isset($orderBy[$dTbl['module_id']])?"display: none;":""?>">
                                    <i class="fa fa-sort-down text<?=$orderBy[$dTbl['module_id']]=="asc"?"-active":""?>"></i>
                                    <i class="fa fa-sort-up text<?=($orderBy[$dTbl['module_id']]=="desc" || !isset($orderBy[$dTbl['module_id']]))?"-active":""?>"></i>
                                    <i class="fa fa-sort"></i>
                            </span>
                        </th> 
                        <th >Name</th>  
                        <th >Email</th> 
                        <th >Date</th>  
                        <th >Status</th>
                        <th >Tool</th>
                      </tr>
                    </thead> 
                    <tbody>

                    <?php
                    $start = $i = (($page-1)*$numRowForPage)+1; 
                    $buildLink = $this->load->library('Model_Build'); 
                    if (!empty($content)) {
                        foreach ($content as $row) {
							// if($row->create_by){
							// 	$this->_model->getDB()->from('tbg_admin');
							// 	$this->_model->getDB()->where('id',$row->create_by);
							// 	$ad_cre = current($this->_model->getDB()->get()->result());
							// }
							// if($row->publish_by){
							// 	$this->_model->getDB()->from('tbg_admin');
							// 	$this->_model->getDB()->where('id',$row->publish_by);
							// 	$ad_pub = current($this->_model->getDB()->get()->result());
							// }
							// if($row->modify_by){
							// 	$this->_model->getDB()->from('tbg_admin');
							// 	$this->_model->getDB()->where('id',$row->modify_by);
							// 	$ad_modify = current($this->_model->getDB()->get()->result());
							// }
         
                        ?>
                        <tr id="<?php echo 'tr_' . $dTbl['module_id']; ?>">
                            <td><?=$i++?></td>
                            <td><?php echo $row->$dTbl['module_id']; ?></td>   
                           
                            <td> 
                                <a style="color: blue;" href="<?php echo base_url() . $dTbl['module_controler'].'/addedit/' . $row->$dTbl['module_id']; ?>" title="<?php echo $row->name; ?>">
                                    Title: <b><?php echo  $row->title; ?></b> <br /> 
                                </a>
                            </td>   
                            <td> 
                                 <b><?php echo $row->email; ?></b>
                            </td>     
                            <td>
                                Create: <b><?php echo  $row->create_date; ?></b> <br />  
                                <?php
                                switch ($row->$dTbl['module_controler']) {
                                  case 'user_email': 
                                    break; 
                                  default:
                                    ?>
                                    Modify: <b><?php echo  $row->modify_date; ?></b> <br />    
                                    Publish: <b><?php echo  $row->publish_date; ?></b> <br />  
                                    <?php
                                    break;
                                }

                                ?> 
                                
                            </td>

                            <td> 
                                <div class="btn-group">
                                  <i  data-toggle="dropdown">
                                    <?php
                                    if($row->status == 0){
                                        ?><a href="javascript:void(0)"  title="Pending">Pending</a><?php
                                    }
                                    if($row->status == 1){
                                        ?><a href="javascript:void(0)"  title="Done">Done</a> <?php
                                    }
                                    if($row->status == 2){
                                        ?><a href="javascript:void(0)"  title="Delete">Delete</a><?php
                                    } 
                                    ?>
                                  </i>
                                  <ul class="dropdown-menu"> 
                                    <?php 
                                    if($row->status != 0){
                                        ?><li><a id="td_<?php echo $row->$dTbl['module_id']; ?>" href="javascript:changeStatusID(0 ,'<?php echo $row->$dTbl['module_id']?>')"> 
                                        Pending</a></li><?php
                                    }
                                    if($row->status != 1){
                                        ?><li><a id="td_<?php echo $row->$dTbl['module_id']; ?>" href="javascript:changeStatusID(1 ,'<?php echo $row->$dTbl['module_id']?>')"> 
                                        Done</a></li><?php
                                    }
                                    if($row->status != 2){
                                        ?><li><a id="td_<?php echo $row->$dTbl['module_id']; ?>" href="javascript:changeStatusID(2 , '<?php echo $row->$dTbl['module_id']; ?>');">
                                        Delete</a></li><?php
                                    } 
                                    ?>
                                    </ul>
                                </div> 
                            </td> 
                            <td>
                                <span>
                                    <a style="color: blue;" href="<?php echo base_url() . $dTbl['module_controler'].'/addedit/' . $row->$dTbl['module_id']; ?>" title="Edit">
                                        [Edit]
                                    </a> 
                                </span>


                                <?php
                                switch ($dTbl['module_controler']) {
                                  case 'tag':
                                    ?>
                                      <span>
                                          <a style="color: blue;" href="javascript:void(0);" onclick="plusTopUse('<?php echo $row->$dTbl['module_id']; ?>');" title="Use Now">
                                              [Use Now]
                                          </a> 
                                      </span>
                                    <?php
                                    break;
                                  
                                  default:
                                    # code...
                                    break;
                                }

                                ?>
                                 

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