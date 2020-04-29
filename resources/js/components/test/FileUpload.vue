<template>
<div class="flex-container">
    <div class="drop-zone">
        <h3>Drop files here..</h3>
    </div>
    <div class="drop-zone">
        <h3>Drop files here..</h3>
    </div>
    <div class="drop-zone">
        <h3>Drop files here..</h3>
    </div>
</div>
    
</template>
<script>
export default {
    data: {

    },
    methods: {

    },

    
}
</script>
<style scoped>
.flex-container {
  display: flex;
  flex-flow: row wrap;
  justify-content: center;
  height: 400px;
  width: 100%;
  background-color: lightgray;
}
.drop-zone {
    max-width: 100px;
    max-height: 100px;
}



</style>