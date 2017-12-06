var ele = document.getElementById('rabbit');
//var posisitons = ['0 -50','-50 -50','-100 -50']
var posisitons = ['1 -470','-174 -470','-349 -470','-523 -470','-697 -470','-872 -470','-872 -105','-697 -105','-523 -105','-349 -105','-174 -105','1 -105'];

var imgUrl = 'rabbit-big.png';

animation(ele,posisitons,imgUrl);

function animation(ele,positions,imgUrl) {
    ele.style.backgroundImage = 'url('+imgUrl+')';
    ele.style.backgroundRepeat = 'no-repeat';
    var index = 0;
    function run() {
        var position = positions[index].split(' ');
        ele.style.backgroundPosition = position[0] + 'px ' + position[1] + 'px';
        index++;
        if(index ==　positions.length) {
            index = 0
        }
        setTimeout(run,100)
    }
    run()
}
