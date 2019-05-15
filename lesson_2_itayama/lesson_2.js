var name= "田中太郎";
var company= "株式会社〇〇";
var seiyu = ["杉田智和","中村悠一","花澤香菜","雨宮天","宮野真守"];
var key;

alert(name + "は" + company + "に所属しています。");
    
for(key in seiyu){
    alert(seiyu[key] + "は、面白い声優です。");
}
