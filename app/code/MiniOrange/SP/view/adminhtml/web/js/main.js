function addCustomAttribute(){
    // console.log("Appending a Custom Attribute.");
    alert("add attribute");
    var val = $("#this_attribute").val();
    var div = generateAttributeDiv($("#this_attribute").val())
     $("#submit_custom_attr").before(div);
     $("#this_attribute").val("");

}

function generateAttributeDiv(name){
    

    var attributeDiv =  $("<div>",{'class':'gm-div','id':name+'Div'});
    var labelForAttr = $("<label>",{'for':name,'class':'form-control gm-input-label'}).text(name);
    var inputAttr = $("<input>",{'id':name,'name':name,'class':'form-control gm-input','type':'text', 'placeholder':'Enter name of IDP attribute'});

    attributeDiv.append(labelForAttr);
    attributeDiv.append(inputAttr);

    return attributeDiv;

}

function deleteCustomAttribute(){
    // console.log("Removing Attribute: ");
    alert("delete attribute");
    var val = $("#this_attribute").val();

    if(val.length>1){
        console.log("Deleting mapping for "+val);
        $('#'+val+'Div').remove();
        $("#this_attribute").val("");}
}
