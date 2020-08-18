<template>
    <div class="container pt-4">
        <div class="bg-dark p-3 text-light rounded">
            <h3 class="mt-0 font-weight-bold text-danger">{{name}}</h3>
            <p class="lead">
                Antes de continuar con el <strong>Borrado</strong>, debes saber que todos
                tus datos seran eliminados y no se podrá recuperar.<br><br>
                Para continuar, has click en eliminar cuenta.
            </p>         
        </div>        
    </div>
</template>

<script>
export default {
    props:['name']
}
</script>