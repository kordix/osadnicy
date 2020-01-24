<template>
    <div>
        <div class="building" :id="attr+'Mine'" style="width:100px;height:100px;left:50px;top:50px;" v-bind:style="{ 'background-image': 'url(' + 'images/'+attr +dane[attr+Level]+'.png)' }"></div>
   </div>
</template>
<script>
export default {
    props:['attr']

    
}
</script>

<style lang="">
    
.building{
    background-size:contain;
    position:absolute;
}


.woodIcon{
    background-size:contain;background-repeat:no-repeat;left:60px;position:relative;width:20px;height:20px;top:25px;
}

.stoneIcon{
    background-size:contain;background-repeat:no-repeat;left:60px;position:relative;width:15px;height:15px;top:22px;
}

.ironIcon{
    background-size:contain;background-repeat:no-repeat;left:60px;position:relative;width:20px;height:20px;top:25px;
}



    
</style>


