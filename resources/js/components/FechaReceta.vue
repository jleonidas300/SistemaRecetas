<template>
    <span>{{ formatearFecha }}</span>   
</template>

<script>
    export default 
    {
        props: ['fecha'],
            computed: 
            {
                formatearFecha()
                {
                    return moment(this.fecha).locale('es').format('DD [de] MMMM [de] YYYY')
                }
            }
        
    }
</script>