$(document).ready(function(){var a=$("#datatable-x");a.on("click",".btn-change-state",function(b){b.preventDefault();$(this).attr("disabled","disabled");$("#modalConfirm").data("process",$(this));$("#modalConfirm .modal-content").load($(this).attr("href"),function(){$("#modalConfirm").modal();a.find(".btn[disabled]").removeAttr("disabled");$("#modalConfirm form").ajaxForm({beforeSuccess:function(){$("#modalConfirm button.btn-primary").attr("disabled","disabled")},success:function(c){$("#modalConfirm").modal("hide");$($("#modalConfirm").data("process")).parent().text(Translator.trans("Updating..."));$("#modalConfirm").removeData("process");a.dataTable().api().draw(true)}})})});a.dataTable({order:[[5,"asc"]],aoColumns:[{name:"name"},{name:"operator"},{name:"client"},{name:"supplier"},{name:"service"},{name:"startAt",searchable:false},{name:"endAt",searchable:false},{name:"reference"},{sortable:false,searchable:false}],processing:true,serverSide:true,ajax:{method:"post",url:Routing.generate("app_notifications_getdata"),data:function(b){return $.extend({},b,{filter:{state:$("#filter-state").val()}})}}});$("#filter-state").on("change",function(){a.dataTable().api().draw(true)})});