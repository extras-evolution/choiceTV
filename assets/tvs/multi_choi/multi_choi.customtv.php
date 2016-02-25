<?php
/**
MULTI CHOICE TV

    Версия  перерабатывалась из ChoiseTV by Dmi3yy <dmi3yy@gmail.com>
 * @copyright 2016 Abadello
 * @version 0.1
 * @license http://opensource.org/licenses/MIT MIT License
 * @author Abadello <ilya@gusev.tel>
 
 */
$sql = 'SELECT DISTINCT `value` FROM '.$modx->getFullTableName('site_tmplvar_contentvalues').' WHERE tmplvarid = '.$field_id.' ORDER BY value ASC';
$result = $modx->db->query( $sql );  
$output = '<div id="out_'.$field_id.'">';
$ii = 0;
while( $row = $modx->db->getRow( $result ) ) {      
    foreach(explode('||',$row['value']) as $kk){
        $all[] = $kk;
    } 
}  
if(is_array($all)){
    $all = array_unique($all);
 
    foreach($all as $value){   
        $ii++;

        foreach (explode('||', $field_value) as $vv) {             
             if($value==$vv){
                $checked = 'checked="checked"';
                break;
             }else $checked = '';
        }
       
        $output .= '<input '.$checked .' type="checkbox" value="'.$value.'" id="tv'.$field_id.'_'.$ii.'" name="tv'.$field_id.'[]" onchange="documentDirty=true;"/>
                    <label for="tv'.$field_id.'_'.$ii.'">'.$value.'</label>
                    
';  
    }
}
$output .= '</div>';
echo '
<script type="text/javascript">

var ii = '.$ii.';

function inpChange'.$field_id.'(inp){    
    ii = ii + 1;    
    var val = document.getElementById(inp).value;
    var out = document.getElementById("out_'.$field_id.'");
    if(val != ""){        
        out.innerHTML = out.innerHTML + "<input checked=\"checked\" type=\"checkbox\" value=\""+ val +"\" id=\"tv'.$field_id.'_" + ii + "\" name=\"tv'.$field_id.'[]\" onchange=\"documentDirty=true;\"/><label for=\"tv'.$field_id.'_" + ii + "\">" + val + "</label>
";
    }
    document.getElementById(inp).value = "";
    return false;
};

</script>
<style type="text/css">
  
</style>'.$output.'
    <input placeholder="Добавить новый элемент"  type="text" id="tv_dop'.$field_id.'" /><input type="button" value="+" onclick="inpChange'.$field_id.'(`tv_dop'.$field_id.'`);">';
?>
