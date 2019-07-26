/* utf.js - UTF-8 <=> UTF-16 convertion
 *
 * Copyright (C) 2010 zys <zys-101@163.com>
 * Version: 1.0
 * LastModified: Six 3, 2010
 * This library is free.  You can redistribute it and/or modify it.
 */

/*
 * Interfaces:
 * utf8 = utf16to8(utf16);
 * utf16 = utf16to8(utf8);
 */

function utf16to8(utf16Str) {
    var utf8Arr = [];
    var byteSize = 0;
    for (var i = 0; i < utf16Str.length; i++) {
        //获取字符Unicode码值
        var code = utf16Str.charCodeAt(i);

        //如果码值是1个字节的范围，则直接写入
        if (code >= 0x00 && code <= 0x7f) {
            byteSize += 1;
            utf8Arr.push(code);

            //如果码值是2个字节以上的范围，则按规则进行填充补码转换
        } else if (code >= 0x80 && code <= 0x7ff) {
            byteSize += 2;
            utf8Arr.push((192 | (31 & (code >> 6))));
            utf8Arr.push((128 | (63 & code)))
        } else if ((code >= 0x800 && code <= 0xd7ff)
            || (code >= 0xe000 && code <= 0xffff)) {
            byteSize += 3;
            utf8Arr.push((224 | (15 & (code >> 12))));
            utf8Arr.push((128 | (63 & (code >> 6))));
            utf8Arr.push((128 | (63 & code)))
        } else if(code >= 0x10000 && code <= 0x10ffff ){
            byteSize += 4;
            utf8Arr.push((240 | (7 & (code >> 18))));
            utf8Arr.push((128 | (63 & (code >> 12))));
            utf8Arr.push((128 | (63 & (code >> 6))));
            utf8Arr.push((128 | (63 & code)))
        }
    }

    return utf8Arr
}

function utf8to16(utf8Arr) {
    var utf16Str = '';

    for (var i = 0; i < utf8Arr.length; i++) {
        //每个字节都转换为2进制字符串进行判断
        var one = utf8Arr[i].toString(2);

        //正则表达式判断该字节是否符合>=2个1和1个0的情况
        var v = one.match(/^1+?(?=0)/);

        //多个字节编码
        if (v && one.length == 8) {
            //获取该编码是多少个字节长度
            var bytesLength = v[0].length;

            //首个字节中的数据,因为首字节有效数据长度为8位减去1个0位，再减去bytesLength位的剩余位数
            var store = utf8Arr[i].toString(2).slice(7 - bytesLength);
            for (var st = 1; st < bytesLength; st++) {
                //后面剩余字节中的数据，因为后面字节都是10xxxxxxx，所以slice中的2指的是去除10
                store += utf8Arr[st + i].toString(2).slice(2)
            }

            //转换为Unicode码值
            utf16Str += String.fromCharCode(parseInt(store, 2));

            //调整剩余字节数
            i += bytesLength - 1
        } else {
            //单个字节编码，和Unicode码值一致，直接将该字节转换为UTF-16
            utf16Str += String.fromCharCode(utf8Arr[i])
        }
    }

    return utf16Str
}