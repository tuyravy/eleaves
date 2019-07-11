<form action="<?php echo site_url('setting/setconfig');?>" method="post">
<table class="table table-condensed">
  <tr>
    <td>ID</td>  
    <td>Config Name</td>
    <td>Description</td>
    <td>Checking</td>
  </tr>
<?php
foreach($configfile as $row)
{  
?>
  <tr>
    <td><?php echo $row->keys;?></td>  
    <td><?php echo $row->option_name;?></td>
    <td><?php echo $row->description;?></td>
    <td>
        
          <div class="checkbox">
            <label>
              <?php 
                switch($row->flag)
                {
                    case 1:
                       echo"<input type='checkbox' checked name='configalredy[]' value='$row->keys'> Already Config";
                    break;
                    case 0:
                        echo"<input type='checkbox' name='config[]'> Set Config";
                    break;
                }
              ?>
              
            </label>
          </div>
    </td>
    
  </tr>  
<?php 
}
?>
<tr>
    <td colspan="4" align="right">
        <button type="sumbit" class="btn btn-primary">Config Now</button>
    </td>  
    
</tr>
</table>
    
</form>