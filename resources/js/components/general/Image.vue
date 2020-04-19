<template>
<div>
    <v-img
        height="250"
        src=this.image
     ></v-img>
</div>
    
    
</template>
<style scoped>

</style>
<script>
export default {

    data: function() {
        return {
            image: null
        }
    },

    methods: {
        getImage() {
            return axios.post('/api/images/pull', payload)
                .then(response => {
                    this.image = response
                })
                .catch(error=> {
                    console.log(error)
                })
        }
    }

    
    

}
</script>