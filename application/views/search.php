<div class="row wrapper">
    <div class="col-sm-12">
        <form class="col-sm-12" method="GET">
                                <div class="col-sm-6">
                          <div class="input-group">
                            <span class="input-group-addon">Từ</span>
                            <input type="text" data-date-format="dd/mm/yyyy"  size="16" style="width:120px;" class="input-s-sm input-s dateimtepk form-control hasDatepicker" id="date_sort_start" name="search[fromDate]" value="<?php echo $search['fromDate']; ?>" />
                            <span class="input-group-addon">đến</span>
                            <input type="text" data-date-format="dd/mm/yyyy"  size="16" style="width:120px;" class="input-s-sm input-s dateimtepk form-control hasDatepicker" id="date_sort_end" name="search[toDate]" value="<?php echo $search['toDate']; ?>" />
                        </div>
                      </div>
                        <script>
                          $(function () {

                            $(".dateimtepk").datepicker({
                              format: "dd/mm/yyyy",
                              language: "vi"
                            });
                          });
                        </script> 
                      <div class="col-sm-6">
                        <div class="input-group">
                          <input type="text" placeholder="Tìm kiếm" value="<?php echo $search['key']; ?>" name="search[key]" class="input-sm form-control">
                          <span class="input-group-btn">
                            <input type="submit" class="btn btn-sm btn-default" value="Tìm">
                          </span>
                        </div>
                      </div>
            </form>
    </div>
</div>