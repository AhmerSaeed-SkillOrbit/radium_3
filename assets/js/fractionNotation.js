function fractionNotation(i,p){
    var input = i;
    if(i){
        input.addEventListener("change",function(){
            alert('sdfsssdf');
            var f = input.value.split(",").join("");
            var d=f.split('.');
            function getNotation(n){
                var d = "";
                for(i=0;i< n.length;i++){
                    d+= n.charAt(i);
                    if(i!=0 && (i+1)%3==0 && (i+1)!= n.length){
                        d+=",";
                    }
                }
                return d;
            }
            f=getNotation(d[0].split("").reverse().join("")).split("").reverse().join("");
            if(d[1]){
                if(p){
                    d[1]= d[1].substring(0,p);
                }
                f+="."+d[1];
            }
            input.value=f;
        });
    }
}