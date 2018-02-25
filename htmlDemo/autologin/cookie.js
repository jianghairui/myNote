var Cookie = {
    set:function (key,val,expiresDays) {
        if(expiresDays) {
            var date = new Date()
            date.setTime(date.getTime() + expiresDays*24*3600*1000)
            var expireStr = 'expires=' + date.toGMTString() + ';'
        }else {
            var expireStr = ''
        }
        document.cookie = key + '=' + escape(val) + ';' + expirestr
    },
    get:function (key) {
        var getCookie = document.cookie.replace(/[ ]/g,'')
        var resArr = getCookie.split(';')
        var res
        for(var i=0,len=resArr.length ;i<len ;i++) {

        }
     }
}