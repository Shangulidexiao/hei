$(function(){
    $(document).on('change','.select-all',function(){
        $this 			= $(this);
        $isChecked 		= $this.attr('checked');
        $inputName 		= $this.attr('for-name');
        $selectInputs           = $("input[name='"+$inputName+"']");

        if($isChecked === 'checked'){
                $selectInputs.attr('checked','checked');
        }else{
                $selectInputs.removeAttr('checked');
        }
    });
    $(document).on('change','.select-one',function(){
        $this                       = $(this);
        $selectAllName              = $this.attr('for-name');
        $selectAll                  = $(".select-all[all-name='"+$selectAllName+"']");
        $checkedInputsNum           = $(".select-one:checked").length;
        $allInputsNum               = $(".select-one").length;
        if($checkedInputsNum === $allInputsNum){
                $selectAll.attr('checked','checked');
        }else{
                $selectAll.removeAttr('checked');
        }
    }); 
});