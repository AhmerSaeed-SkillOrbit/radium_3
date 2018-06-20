
function fractionNotation(f,p){
    f = f+"";
    f = f.split(",").join("");
    var d=f.split('.');
    function getNotation(n){
        var d = "";
        for(var i=0;i< n.length;i++){
            d+= n.charAt(i);
            if(i!=0 && (i+1)%3==0 && (i+1)!= n.length){
                d+=",";
            }
        }
        return d;
    }
    f=getNotation(d[0].split("").reverse().join("")).split("").reverse().join("");
    if(p && p>0){
        if(d[1]){
            d[1]= d[1].substring(0,p);
            f+="."+d[1];
        }
        else{
            var n="";
            for(var i=0;i<p;i++){
                n+="0";
            }
            if(n!=""){
                f+="."+n;
            }
        }
    }
    return f;
}


//Old One
//function fractionNotation(f,p){
//    console.log();
//    f=f+"";
//    f = f.split(",").join("");
//            var d=f.split('.');
//            function getNotation(n){
//                var d = "";
//                for(i=0;i< n.length;i++){
//                    d+= n.charAt(i);
//                    if(i!=0 && (i+1)%3==0 && (i+1)!= n.length){
//                        d+=",";
//                    }
//                }
//                return d;
//            }
//            f=getNotation(d[0].split("").reverse().join("")).split("").reverse().join("");
//            if(d[1]){
//                if(p){
//                    d[1]= d[1].substring(0,p);
//                }
//                f+="."+d[1];
//            }
//			return f;
//}