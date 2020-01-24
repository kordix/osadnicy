<template>
<div class="popover fade show bs-popover-right"  id="popover478368" style="position: absolute; will-change: transform;" :style="{top:$parent.top+'px',left:$parent.left+90+'px'} ">
    <div class="arrow" style="top: 22px;"></div>
    <h4 class="popover-header">{{$parent.popheader}}</h4>
    <div class="popover-body"><slot></slot></div>
</div>
</template>

<script>
export default {

}
</script>

<style scoped>
.elem{
position: absolute;
will-change: transform;
top: 0px;
left: 0px;
/* transform: translate3d(0px, 0px, 0px); */
}

.popover-header {
padding: 0.5rem 0.75rem;
margin-bottom: 0;
font-size: 0.9rem;
background-color: #f7f7f7;
border-bottom: 1px solid #ebebeb;
border-top-left-radius: calc(0.3rem - 1px);
border-top-right-radius: calc(0.3rem - 1px);
}

.bs-popover-right, .bs-popover-auto[x-placement^="right"] {
    margin-left: 0.5rem;
}

.popover {
    cursor:pointer;
    width:200px;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1060;
    display: block;
    max-width: 400px;
    font-family: "Nunito", sans-serif;
    font-style: normal;
    font-weight: 400;
    line-height: 1.6;
    text-align: left;
    text-align: start;
    text-decoration: none;
    text-shadow: none;
    text-transform: none;
    letter-spacing: normal;
    word-break: normal;
    word-spacing: normal;
    white-space: normal;
    line-break: auto;
    font-size: 0.7875rem;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0.3rem;
}

.bs-popover-right > .arrow, .bs-popover-auto[x-placement^="right"] > .arrow {
    left: calc((0.5rem + 1px) * -1);
    width: 0.5rem;
    height: 1rem;
    margin: 0.3rem 0;
}

.popover .arrow {
    position: absolute;
    display: block;
    width: 1rem;
    height: 0.5rem;
    /* margin: 0 0.3rem; */
}

</style>
