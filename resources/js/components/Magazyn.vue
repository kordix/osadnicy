<template>
  <div @click="pop=!pop">
          <div id="magazyn" class="building" style="height:90px;" v-bind:style="{ 'background-image': 'url(images/Mag'+dane[attr+'Store']+'.png)',left:left+'px',top:top+'px',width:width+'px' }" >
                <div  :class="attr+'Icon'" :style="{'background-image':'url(images/'+ attr +'.png'}"></div>
            </div>
    <popover v-if="pop">Level: {{dane[attr+'Store']}} Pojemnosć {{dane[attr+'Store'] * 100+200}} 
      <button type="button" name="button" @click="$parent.upgradeMag(attr)">Upgrade</button>

    </popover>

    

  </div>
</template>
<script>
import {mapState} from 'vuex';

export default {
  props: ['attr','width','height','left','top','type'],
  data(){
    return {
      pop:false
    }
  },
  computed: {
    ...mapState({
      dane: "dane"
    }),
    popheader(){
      return 'Magazyn '+this.attr;
    }
  }
};
</script>

<style scoped>
.building {
  background-size: contain;
  position: absolute;
}

.building:hover{
  opacity:0.6;
  cursor:pointer;

}


.woodIcon {
  background-size: contain;
  background-repeat: no-repeat;
  left: 60px;
  position: relative;
  width: 20px;
  height: 20px;
  top: 25px;
}

.stoneIcon {
  background-size: contain;
  background-repeat: no-repeat;
  left: 60px;
  position: relative;
  width: 15px;
  height: 15px;
  top: 22px;
}

.ironIcon {
  background-size: contain;
  background-repeat: no-repeat;
  left: 60px;
  position: relative;
  width: 15px;
  height: 15px;
  top: 22px;
}
</style>


