/**
 * Created by BF on 2017/10/20.
 */
function toRoute(val)
{
    var url = document.URL;
    var path = url.split('web');
    return path[0]+'web'+'/'+val;
}
