;
$(document).ready(function(){
   TouchSlide({
       slideCell:"#slideBox",
       titCell:".hd ul",
       mainCell:".bd ul",
       autoPage:true,
       effect:"leftLoop",
       autoPlay:true,
       delayTime:400,
       interTime:3500,
       prevCell:".prev",
       nextCell:".next",
   });
});
