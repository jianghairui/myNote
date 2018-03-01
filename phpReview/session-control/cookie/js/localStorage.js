var Custom_localStorage = {
    //添加缓存时间:7天
    set:function (key,value,days) {
        var item = {
            data:value,
            endTime:new Date().getTime() + days*3600*24*1000
        }
        localStorage.setItem(key,JSON.stringify(item))
    },
    get:function (key) {
        var val = localStorage.getItem(key)
        if(!val) return null
        val = JSON.parse(val)
        if(new Date().getTime() > val.endTime) {
            val = null
            localStorage.removeItem(key)
        }
        return val.data
    },
    remove:function (key) {
        localStorage.removeItem(key)
        return null
    },
    removeAll:function () {
        localStorage.clear()
        return null
    }
}