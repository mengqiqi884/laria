/**
 * Created by BF on 2016/11/7.
 */
/*初始化table*/
$('.grid-view table').bootstrapTable({
    url: '/Export/GetDepartment',         //请求后台的URL（*）
    method: 'get',                      //请求方式（*）
    toolbar: '#toolbar',                //工具按钮用哪个容器
    striped: true,                      //是否显示行间隔色
    cache: false,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
    pagination: true,                   //是否显示分页（*）
    sortable: false,                     //是否启用排序
    sortOrder: "asc",                   //排序方式
    queryParams: oTableInit.queryParams,//传递参数（*）
    sidePagination: "client",           //分页方式：client客户端分页，server服务端分页（*）
    pageNumber: 1,                       //初始化加载第一页，默认第一页
    pageSize: 10,                       //每页的记录行数（*）
    pageList: [10, 25, 50, 100],        //可供选择的每页的行数（*）
    clickToSelect:true,
    showExport: true,                     //是否显示导出
    exportDataType: "basic",              //basic', 'all', 'selected'.
    columns: [{
        checkbox: true
    }, {
        field: 'Name',
        title: '部门名称'
    }, {
        field: 'ParentName',
        title: '上级部门'
    }, {
        field: 'Level',
        title: '部门级别'
    }, {
        field: 'Desc',
        title: '描述'
    }]
});