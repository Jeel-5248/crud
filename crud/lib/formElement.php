<?php
    function form_element($elemetType,$label,$inputtype,$name,$value=null,$placeholder=null,$id=null,$class=null,$attr=null){
        switch ($elemetType){
            case 'text';
            echo "<div class='form-group'>";
            echo "<br> <label>$label</label> <input  type='$inputtype' name='$name' value='$value' placeholder='$placeholder' class='$class' id='$id' attr='$attr'> ";
            echo "</div>";
            break;

            case 'select';
            echo "<label>$label</label>
            <select name='$name' id='$id' >
                <option value='select' selected>Select one</option>";
                foreach($value as  $value1){
                   echo "<option value=$value1 ".(isset($_POST[$name]) ? (($_POST[$name] == $value1) ? 'selected' : '') : '')  . ">$value1</option>";
                }
                echo "</select>";
             break;
        }

    }
?>