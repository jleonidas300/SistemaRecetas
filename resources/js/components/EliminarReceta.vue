<template>
   <input 
    type="submit" 
    value="X" 
    class="btn btn-danger"
    @click="eliminarReceta">
</template>

<script>
export default 
{
    props: ['recetaId'],
            methods: 
            {
                eliminarReceta()
                {
                        this.$swal({
                        title: '¿Desea eliminar la receta?',
                        text: "Una vez eliminada, no se recupera!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No'
                    }).then((result) => {
                    if (result.isConfirmed) 
                        {
                            const params ={
                                id: this.recetaId
                            }
                            //enviando peticion al servidor apra eliminar
                            axios.post(`/recetas/${this.recetaId}`, {params, _method: 'delete'})
                            .then(respuesta => {
                                  this.$swal({
                                    title: 'Receta eliminada',
                                    text: 'Se eliminó la receta',
                                    icon: 'success'
                                    })
                                    
                                    //eliminar receta del Dom
                                    //console.log(this.$el); para ver el elemento que realiza el trabajo
                                    this.$el.parentNode.parentNode.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode.parentNode.parentNode);
                            })
                            .catch(error => {
                                console.log(error)
                            })

                          
                        }
                    })
                }
           
            }
}
</script>